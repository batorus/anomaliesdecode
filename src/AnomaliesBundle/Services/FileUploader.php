<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AnomaliesBundle\Services;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AnomaliesBundle\Entity\Documents;

use AnomaliesBundle\Helpers\SimpleImage; 

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\EntityRepository;

class FileUploader {
    
    private $nameFromType;
    private $nameFileField;   
    
    public function __construct(){
        $this->nameFromType = 'anomaliesbundle_documents';
        $this->nameFileField = 'userfile';        
    }
    
    public function uploadAction(Request $request, $id, $em, $container)
    {      
     
        $docsentity = new Documents();        
        $entity = $em->getRepository('AnomaliesBundle:User')->find($id);    

        if(!empty($request->request->all()))
        {

            $fs = new Filesystem();  
           
            if($request->files->get('anomaliesbundle_documents')['userfile'] != null)
            {


                     $uf = new UploadedFile($request->files->get($this->nameFromType)[$this->nameFileField], 
                                            $request->files->get($this->nameFromType)[$this->nameFileField]->getClientOriginalName());
                     // echo "<pre>";  
                      //echivalent cu $_FILES["userfile"]["tmp_name"]
                     // print_r($request->files->get('anomaliesbundle_documents')['userfile']->getPathName());die();  
                     
                    //test to see if the uploaded file is an image
                    $check = getimagesize($request->files->get($this->nameFromType)[$this->nameFileField]->getPathName());

                    if ($check !== false) 
                    {
                        $isimage = true;
                    } 
                    else 
                    {
                        $isimage = false;
                    }
                     

                    
                if($isimage)
                { 
                     $target_dir = realpath($container->getParameter('kernel.root_dir').'/../web/bundles/anomaliesdecode/images/originals');

                     $target_file = $target_dir ."/".$request->files->get($this->nameFromType)[$this->nameFileField]->getClientOriginalName();

                     $tmb_dir = realpath($container->getParameter('kernel.root_dir').'/../web/bundles/anomaliesdecode/images/thumbs');
                     $uploadOk = 1;

                     $imagefiletype = pathinfo($target_file, PATHINFO_EXTENSION);
                     $imagename = pathinfo($target_file, PATHINFO_FILENAME);
                      
                     
                    // Check if file already exists                    
                    if (file_exists($target_file)) 
                    {
                        $container->get('session')->getFlashBag()->add("error", "Le fichier existe déjà.");                   
                        $uploadOk = 0;
                    }
                
                     
                    if ($uploadOk == 0) 
                    {
                        $container->get('session')->getFlashBag()->add("error", "Votre fichier n'a pas été téléchargé.");
                    } 
                    else 
                    {
                        //echivalent cu: move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)           
                        if($uf->move($target_dir, $request->files->get($this->nameFromType)[$this->nameFileField]->getClientOriginalName())) {

                            $image = new SimpleImage($target_file);
                             
                             //width x height
                             //$image->resizeToHeight(300);
                             //$image->resizeToWidth(300);
                             
                            $image->crop(200,200);
                            //$tmb_path = $tmb_dir."/".basename($_FILES["userfile"]["name"]);
                            $tmb_path = $tmb_dir."/".$request->files->get($this->nameFromType)[$this->nameFileField]->getClientOriginalName();
                            $image->save($tmb_path); 
                                                        
                            $docsentity->setDescription($request->request->get('anomaliesbundle_documents')['description']);
                            $docsentity->setName($imagename);                              
                            $docsentity->setExtension($imagefiletype);                            
                            $docsentity->setEnabled(1);   
                            
                            ####################### O ->M implementare ########################                            
                            $docsentity->setUser($entity);
//
//                            $em->persist($entity);
                            $em->persist($docsentity);
                            ####################### O->M implemetare ########################     
                            
                            try
                            {     
                                 $em->flush();
                            }
                            catch(Doctrine\ORM\ORMException $e)
                            {           

                            }  
                           
                        } 
                        else 
                        {
                             $container->get('session')->getFlashBag()->add("error", "Une erreur s'est produite lors de l'envoi de votre fichier !");
                        }
                    }              
                }
                else
                {
                     $target_dir_documents = realpath($container->getParameter('kernel.root_dir').'/../web/bundles/anomaliesdecode/documents');
                     
                     //$target_file = $target_dir ."/". basename($_FILES["userfile"]["name"]);
                     $target_file = $target_dir_documents ."/".$request->files->get('anomaliesbundle_documents')['userfile']->getClientOriginalName();
                                        
                     $uploadOk = 1;

                     $filetype = pathinfo($target_file, PATHINFO_EXTENSION);
                     $filename = pathinfo($target_file, PATHINFO_FILENAME);
                                         
                    // Check if file already exists                    
                    if (file_exists($target_file)) 
                    {
                        $container->get('session')->getFlashBag()->add("error", "Le fichier existe déjà.");                   
                        $uploadOk = 0;
                    }
                                    
                    if ($uploadOk == 0) 
                    {
                        $container->get('session')->getFlashBag()->add("error", "Votre fichier n'a pas été téléchargé.");
                    } 
                    else 
                    {
                            //echivalent cu: move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)           
                         if ($uf->move($target_dir_documents, $request->files->get('anomaliesbundle_documents')['userfile']->getClientOriginalName()) ) 
                            {
                                                                                     
                            $docsentity->setDescription($request->request->get('anomaliesbundle_documents')['description']);
                            $docsentity->setName($filename);                              
                            $docsentity->setExtension($filetype);                            
                            $docsentity->setEnabled(1);   
                            
                            ####################### O->M implemetare ########################                            
                            $docsentity->setUser($entity);
                            $em->persist($docsentity);
                            ####################### O->M implemetare ########################     
                            
                            try
                            {     
                                 $em->flush();
                            }
                            catch(Doctrine\ORM\ORMException $e)
                            {           

                            }  
                           
                        } else {

                             $container->get('session')->getFlashBag()->add("error", "Une erreur s'est produite lors de l'envoi de votre fichier !");

                        }
                    }                   
                    
                }   
            }
            else
            {
                $container->get('session')->getFlashBag()->add("error", "Vous devez sélectionner un fichier !");
            }
        }
             
    }
    
    public function deletedocumentAction($did, $em, $container)
    {     
       // die($did);
        $fs = new Filesystem();  

      //  $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AnomaliesBundle:Documents')->find($did);
//dump($entity);die();
        if (!$entity) 
        {
           die('Unable to find entity.');
        }
        
        ################### NEEDS FURTHER ABSTRACTION!!!!!!!!!!!!!!!!!!!!!
        if(  
               is_file($container->getParameter('kernel.root_dir').'/../web/bundles/anomaliesdecode/images/thumbs/'.$entity->getName().".".$entity->getExtension())
            && is_file($container->getParameter('kernel.root_dir').'/../web/bundles/anomaliesdecode/images/originals/'.$entity->getName().".".$entity->getExtension())
        )
        {
            $target_dir = realpath($container->getParameter('kernel.root_dir').'/../web/bundles/anomaliesdecode/images/originals');
            $tmb_dir = realpath($container->getParameter('kernel.root_dir').'/../web/bundles/anomaliesdecode/images/thumbs');

            $thumb_path = $tmb_dir."/".$entity->getName().".".$entity->getExtension();
            $img_path =  $target_dir."/".$entity->getName().".".$entity->getExtension();

            //echivalent cu unlink($img_path);
            $fs->remove(array($img_path, $thumb_path));
        }
        elseif(is_file($container->getParameter('kernel.root_dir').'/../web/bundles/anomaliesdecode/documents/'.$entity->getName().".".$entity->getExtension()))
        {
            $target_dir = realpath($container->getParameter('kernel.root_dir').'/../web/bundles/anomaliesdecode/documents');

            $filepath =  $target_dir."/".$entity->getName().".".$entity->getExtension();

            //echivalent cu unlink($img_path);
            $fs->remove(array($filepath));         
        }

        //foreach($entity->getFkdocuments() as $doc)
        // $em->remove($doc);
        //$entity->setEnabled(0);  
        
        $em->remove($entity);
        $em->flush();
        
        //return $this->redirect($this->generateUrl('processanomalies_edit', array('id' => $id)));    
    }
}
