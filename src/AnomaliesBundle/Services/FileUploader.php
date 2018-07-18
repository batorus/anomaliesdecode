<?php

namespace AnomaliesBundle\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use AnomaliesBundle\Entity\Documents;

use AnomaliesBundle\Helpers\SimpleImage; 

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FileUploader {
    
    private $nameFromType;
    private $nameFileField;   
    private $nameDescriptionField;   
    private $pathToImagesOriginals;
    private $pathToImagesThumbs;
    private $pathToDocuments;
    
    public function __construct(Request $request, $em, $container){
        
        $this->fs = new Filesystem();  
        $this->request = $request;
        $this->container = $container;
        $this->em = $em;
        
       
        //path to redirect in case of exception raised
        $this->route = "roleuser_edit";
             
        //the name from the type of form
        $this->nameFromType = 'anomaliesbundle_documents';
        $this->nameFileField = 'userfile';    
        $this->nameDescriptionField = 'description';  
        
        $this->pathToImagesOriginals = $container->getParameter('rootDir').'/../web/bundles/anomaliesdecode/images/originals';
        $this->pathToImagesThumbs = $container->getParameter('kernel.root_dir').'/../web/bundles/anomaliesdecode/images/thumbs';
        $this->pathToDocuments = $container->getParameter('kernel.root_dir').'/../web/bundles/anomaliesdecode/documents';
    }
    
    private function insertRecord($id, $description, $imagename, $imagefiletype)
    {        

        try{
            $docsentity = new Documents();
            $user= $this->em->getRepository('AnomaliesBundle:User')->find($id); 
            if(!$user){
                throw new \Doctrine\Common\Persistence\Mapping\MappingException("Entity not found!");
            }

             if(!$docsentity){
                throw new \Doctrine\Common\Persistence\Mapping\MappingException("Entity not found!");
            }
        }catch(\Doctrine\Common\Persistence\Mapping\MappingException $e){
            $this->container->get('session')->getFlashBag()->add("error", "Entity does not exist!"); 
           // return new RedirectResponse($this->container->get('router')->generate($this->route, array('id' => $id)));

            return false;
        }   


            $docsentity->setDescription($description);
            $docsentity->setName($imagename);                              
            $docsentity->setExtension($imagefiletype);                            
            $docsentity->setEnabled(1); 
            //One->Many
            $docsentity->setUser($user);      
            $this->em->persist($docsentity);            

        try
        {     
            $this->em->flush();
        }
        catch(Doctrine\ORM\ORMException $e)
        {     
            $this->container->get('session')->getFlashBag()->add("error", "Error during save operation!");                                    
            //return new RedirectResponse($this->container->get('router')->generate($this->route, array('id' => $id)));
            return false;
        }   
        
        return true;
    }
    
    private function getDocument($id)
    {
        
        $entity = null;
        try{
            $entity = $this->em->getRepository('AnomaliesBundle:Documents')->find($id);
           //$this->entity = $this->em->getRepository('AnomaliesBundle:User')->find($id); 
            if(!$entity){
                throw new \Doctrine\Common\Persistence\Mapping\MappingException("Entity not found!");
            }
        }catch(\Doctrine\Common\Persistence\Mapping\MappingException $e){
            $this->container->get('session')->getFlashBag()->add("error", $e->getMessage()); 
            //return new RedirectResponse($this->container->get('router')->generate($this->route, array('id' => $this->id)));
            return false;
        }
        
        return $entity;
        
    }
    
    private function updateRecord($id, $description, $imagename, $imagefiletype)
    {                               
 
        $document = $this->getDocument($id);
                
        if(is_object($document)){
            
            $document->setDescription($description);
            $document->setName($imagename);                              
            $document->setExtension($imagefiletype);                            
            $document->setEnabled(1); 
          

            try
            {     
                $this->em->flush();

            }
            catch(Doctrine\ORM\ORMException $e)
            {     
                $this->container->get('session')->getFlashBag()->add("error", "Error during save operation!");                                    
               // return new RedirectResponse($this->container->get('router')->generate($this->route, array('id' => $user->getId())));
                return false;
            } 
        }
        
        return false;
    }
    
    //true->insert; false->update
    public function uploadAction($id, $insertOrUpload = true)
    {        
        if(!empty($this->request->request->all()))
        {       
            if($this->request->files->get($this->nameFromType)[$this->nameFileField] != null)
            {

                $uf = new UploadedFile($this->request->files->get($this->nameFromType)[$this->nameFileField], 
                                       $this->request->files->get($this->nameFromType)[$this->nameFileField]->getClientOriginalName());

                     
                    //test to see if the uploaded file is an image
                $check = getimagesize($this->request->files->get($this->nameFromType)[$this->nameFileField]->getPathName());

                if($check !== false)
                { 
                     $target_dir = realpath($this->pathToImagesOriginals);

                     $target_file = $target_dir ."/".$this->request->files->get($this->nameFromType)[$this->nameFileField]->getClientOriginalName();

                     $tmb_dir = realpath($this->pathToImagesThumbs);
                     //$uploadOk = 1;

                     $imagefiletype = pathinfo($target_file, PATHINFO_EXTENSION);
                     $imagename = pathinfo($target_file, PATHINFO_FILENAME);
                      

                    // Check if file already exists                    
                    if (file_exists($target_file)) 
                    {
                        $this->container->get('session')->getFlashBag()->add("error", "Le fichier existe déjà.");   
                       // return new RedirectResponse($this->container->get('router')->generate($this->route, array('id' => $id)));  
                       return false;

                    }else{   
                            //Eroarea e pierduta aici????
                            //de rezolvat si pt documente!!!!
                              //trebuie afisata in campul din view
                            $description = $this->request->request->get($this->nameFromType)[$this->nameDescriptionField];   
                            if(empty($description)){
                                
                                $this->container->get('session')->getFlashBag()->add("error", "Empty Description");                               
                                return false;
                            }
                        try{

                            $uf->move($target_dir, $this->request->files->get($this->nameFromType)[$this->nameFileField]->getClientOriginalName());     

                            //forteaza aici exceptia ca sa testezi executia din catch
                           // throw new FileException(); 
                        } catch (FileException $ex) {

                            $this->container->get('session')->getFlashBag()->add("error", "Une erreur s'est produite lors de l'envoi de votre fichier !");
                            //die("not ok");
                            //return new RedirectResponse($this->container->get('router')->generate($this->route, array('id' => $id)));
                            return false;

                        }
                            $image = new SimpleImage($target_file);
                             
                             //width x height
                             //$image->resizeToHeight(300);
                             //$image->resizeToWidth(300);
                             
                            $image->crop(200,200);

                            $tmb_path = $tmb_dir."/".$this->request->files->get($this->nameFromType)[$this->nameFileField]->getClientOriginalName();
                            $image->save($tmb_path); 
 
  
                            
                            //INSERT THE IMAGE HERE   
                        if($insertOrUpload == true){
                         $this->insertRecord($id, $description, $imagename, $imagefiletype);
                        }
                        else {
                         $this->updateRecord($id, $description, $imagename, $imagefiletype); 
                        }
                    }              
                }
                else
                {
                     $target_dir_documents = realpath($this->pathToDocuments);                     
                     $target_file = $target_dir_documents ."/".$this->request->files->get($this->nameFromType)[$this->nameFileField]->getClientOriginalName();
                                        
                     $uploadOk = 1;

                     $filetype = pathinfo($target_file, PATHINFO_EXTENSION);
                     $filename = pathinfo($target_file, PATHINFO_FILENAME);
                                         
                    // Check if file already exists                    
                    if (file_exists($target_file)) 
                    {
                        $this->container->get('session')->getFlashBag()->add("error", "Le fichier existe déjà."); 
                       // return new RedirectResponse($this->container->get('router')->generate($this->route, array('id' => $id)));  
                        return false;

                    }else{

                        try{

                            $uf->move($target_dir_documents, $this->request->files->get($this->nameFromType)[$this->nameFileField]->getClientOriginalName());     
                           // throw new FileException();
                        } catch (FileException $ex) {

                            $this->container->get('session')->getFlashBag()->add("error", "Une erreur s'est produite lors de l'envoi de votre fichier !");

                            //return new RedirectResponse($this->container->get('router')->generate($this->route, array('id' => $id))); 
                            return false;

                        } 

                        $description = $this->request->request->get($this->nameFromType)[$this->nameDescriptionField];   

                        //INSERT THE DOCUMENT HERE                            

                        if($insertOrUpload == true)
                         $this->insertRecord($id, $description, $filename, $filetype);
                        else 
                         $this->updateRecord($id, $description, $filename, $filetype); 
                    }
                    
                }   
            }
            else
            {
                $this->container->get('session')->getFlashBag()->add("error", "Vous devez sélectionner un fichier !");
                return false;
            }
        }
        else{
            return false;
        }    
        
        return true;
    }
    
    public function deletedocumentAction($did)
    {     
  
        try{
            $entity = $this->em->getRepository('AnomaliesBundle:Documents')->find($did);
           //$this->entity = $this->em->getRepository('AnomaliesBundle:User')->find($id); 
            if(!$entity){
                throw new \Doctrine\Common\Persistence\Mapping\MappingException("Entity not found!");
            }
        }catch(\Doctrine\Common\Persistence\Mapping\MappingException $e){
            $this->container->get('session')->getFlashBag()->add("error", "Entity does not exist!"); 
            return new RedirectResponse($this->container->get('router')->generate($this->route, array('id' => $this->id)));
        }
               

        if(  
               is_file($this->pathToImagesThumbs.'/'.$entity->getName().".".$entity->getExtension())
            && is_file($this->pathToImagesOriginals.'/'.$entity->getName().".".$entity->getExtension())
        )
        {
            $targetDir = realpath($this->pathToImagesOriginals);
            $tmbDir = realpath($this->pathToImagesThumbs);

            $thumbPath = $tmbDir."/".$entity->getName().".".$entity->getExtension();
            $imgPath =  $targetDir."/".$entity->getName().".".$entity->getExtension();

            //echivalent cu unlink($img_path);
            $this->fs->remove(array($imgPath, $thumbPath));
        }
        elseif(is_file($this->pathToDocuments.'/'.$entity->getName().".".$entity->getExtension()))
        {
            $targetDir = realpath($this->pathToDocuments);

            $filePath =  $targetDir."/".$entity->getName().".".$entity->getExtension();

            //echivalent cu unlink($img_path);
            $this->fs->remove(array($filePath));         
        }

    
        $this->em->remove($entity);
        $this->em->flush();
 
    }
    
    public function updatedocumentAction($did, $id)
    {
       
        $document = $this->getDocument($did);
        if(is_object($document)){

            $tempPath = $document->getName().".".$document->getExtension();
    
            $response = $this->uploadAction($did, false);

            if($response != false){
                if(  
                       is_file($this->pathToImagesThumbs.'/'.$tempPath)
                    && is_file($this->pathToImagesOriginals.'/'.$tempPath)
                )
                {
                    $targetDir = realpath($this->pathToImagesOriginals);
                    $tmbDir = realpath($this->pathToImagesThumbs);

                    $thumbPath = $tmbDir."/".$tempPath;
                    $imgPath =  $targetDir."/".$tempPath;

                    //echivalent cu unlink($img_path);
                    $this->fs->remove(array($imgPath, $thumbPath));


                }
                elseif(is_file($this->pathToDocuments.'/'.$tempPath))
                {

                    $targetDir = realpath($this->pathToDocuments);
                    $filePath =  $targetDir."/".$tempPath;

                   //echivalent cu unlink($img_path);
                    $this->fs->remove(array($filePath));   

                }
            }
        }else
            $this->container->get('session')->getFlashBag()->add("error", "Not an object!"); 

    }
}
