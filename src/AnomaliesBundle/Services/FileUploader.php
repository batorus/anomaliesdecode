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
    
    public function uploadAction(Request $request, $id, $em, $container)
    {      
//        echo "<pre>";
//        print_r($request);die();
         
        $docsentity = new Documents();        
        $entity = $em->getRepository('AnomaliesBundle:User')->find($id);    
//        
//        $form = $this->createForm(new ProcessanomaliesType($this->container), $entity);         
//        
//        $upform = $this->createForm(new DocumentsType(), $docsentity);
//            
//        $upform->handleRequest($request);
//        $validator = $this->get('validator');
//        
//        $uperrors = $validator->validate($upform); 
//        
//       
//        if (count($uperrors) > 0) 
//        {          
//            return $this->render('AnomaliesBundle:Processanomalies:edit.html.php', array(
//                                 'entity' => $entity,
//                                 'form'   => $form->createView(),                
//                                 'upform'   => $upform->createView(),
//                                 'uperrors' => $uperrors,
//                                 'documents' => $entity->getFkdocuments()                
//                ));
//        }
        
       // var_dump($container->getParameter('kernel.root_dir'));die();
        if(!empty($request->request->all()))
        {

            $fs = new Filesystem();  
           
            if($request->files->get('anomaliesbundle_documents')['userfile'] != null)
            {


                     $uf = new UploadedFile($request->files->get('anomaliesbundle_documents')['userfile'], 
                                            $request->files->get('anomaliesbundle_documents')['userfile']->getClientOriginalName());
                     // echo "<pre>";  
                      //echivalent cu $_FILES["userfile"]["tmp_name"]
                     // print_r($request->files->get('anomaliesbundle_documents')['userfile']->getPathName());die();  
                     
                    //test to see if the uploaded file is an image
                    $check = getimagesize($request->files->get('anomaliesbundle_documents')['userfile']->getPathName());

                    if ($check !== false) 
                    {
                        $isimage = true;
                    } 
                    else 
                    {
                        $isimage = false;
                    }
                     
                  //  var_dump($isimage);die();
                    
                if($isimage)
                { 
                     $target_dir = realpath($container->getParameter('kernel.root_dir').'/../web/bundles/anomaliesdecode/images/originals');
                     //$target_file = $target_dir ."/". basename($_FILES["userfile"]["name"]);
                     $target_file = $target_dir ."/".$request->files->get('anomaliesbundle_documents')['userfile']->getClientOriginalName();
                     //die($target_file);
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
                         if (
                               $uf->move($target_dir, $request->files->get('anomaliesbundle_documents')['userfile']->getClientOriginalName())
                             ) 
                            {
                             
                             //echo "The file " . basename($_FILES["userfile"]["name"]) . " has been uploaded.";

                             $image = new SimpleImage($target_file);
                             
                             //width x height
                             //$image->resizeToHeight(300);
                             //$image->resizeToWidth(300);
                             
                             $image->crop(200,200);
                            //$tmb_path = $tmb_dir."/".basename($_FILES["userfile"]["name"]);
                             $tmb_path = $tmb_dir."/".$request->files->get('anomaliesbundle_documents')['userfile']->getClientOriginalName();
                             $image->save($tmb_path); 
                             
                             
   
                            $docsentity->setDescription($request->request->get('anomaliesbundle_documents')['description']);
                            $docsentity->setName($imagename);                              
                            $docsentity->setExtension($imagefiletype);                            
                            $docsentity->setEnabled(1);   
                            
                            ####################### M<->M implemetare ########################                            
                            $docsentity->setUser($entity);
//
//                            $em->persist($entity);
                            $em->persist($docsentity);
                            ####################### M<->M implemetare ########################     
                            
                            try
                            {     
                                 $em->flush();
                            }
                            catch(Doctrine\ORM\ORMException $e)
                            {           
                                //return $this->redirectToRoute('roleuser_update',array('id'=>$id));
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
                     
                     //die($target_file);
                     //$tmb_dir = realpath($this->container->getParameter('kernel.root_dir').'/../web/bundles/anomalies/images/thumbs');
                     
                     $uploadOk = 1;
//
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
                     //redirect aici cu mesaj in flashbag                        
                         //echo "Sorry, your file was not uploaded.";die();
                        $container->get('session')->getFlashBag()->add("error", "Votre fichier n'a pas été téléchargé.");
                    } 
                    else 
                    {
                            //echivalent cu: move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)           
                         if (
                               $uf->move($target_dir_documents, $request->files->get('anomaliesbundle_documents')['userfile']->getClientOriginalName())
                             ) 
                            {
                             
                             //echo "The file " . basename($_FILES["userfile"]["name"]) . " has been uploaded.";
//
//                             $image = new SimpleImage($target_file);
//                             
//                             //width x height
//                             //$image->resizeToHeight(300);
//                             //$image->resizeToWidth(300);
//                             
//                             $image->crop(200,200);
//                            //$tmb_path = $tmb_dir."/".basename($_FILES["userfile"]["name"]);
//                             $tmb_path = $tmb_dir."/".$request->files->get('anomaliesbundle_documents')['userfile']->getClientOriginalName();
//                             $image->save($tmb_path); 
//                             
                               
                            $docsentity->setDescription($request->request->get('anomaliesbundle_documents')['description']);
                            $docsentity->setName($filename);                              
                            $docsentity->setExtension($filetype);                            
                            $docsentity->setEnabled(1);   
                            
                            ####################### M<->M implemetare ########################                            
//                            $entity->getFkdocuments()->add($docsentity);
                            $docsentity->setUser($entity);
//
//                            $em->persist($entity);
                            $em->persist($docsentity);
                            ####################### M<->M implemetare ########################     
                            
                            try
                            {     
                                 $em->flush();
                            }
                            catch(Doctrine\ORM\ORMException $e)
                            {           
                                //return $container->redirectToRoute('roleuser_update',array('id'=>$id));
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
        
       // return $container->get('router')->generate('roleuser_update',array('id'=>$id)); 
        
    }
}
