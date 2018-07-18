<?php

namespace AnomaliesBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AnomaliesBundle\Entity\Documents;


use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use AnomaliesBundle\Form\ProcessanomaliesForms;
use AnomaliesBundle\Form\ProcessanomaliesType;
use AnomaliesBundle\Form\DocumentsType;
use AnomaliesBundle\Helpers\SimpleImage;  

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\EntityRepository;

################################## UNUSED CONTROLLER; FUNCTIONALITY MOVED INTO FILEUPLOADER #######################################


class DocumentsController extends Controller
{
    
    
############################################# START UPDATE #########################################
####################################################################################################  
     
    public function updateAction(Request $request, $id)
    {     
        $em = $this->getDoctrine()->getManager();
        
                   //var_dump($_FILES); die();
       // echo "<pre>";
       // print_r($request->files->get('anomaliesbundle_documents')['userfile']->getClientOriginalName());die();
      // return $this->redirect($this->generateUrl('_stravaedituserdetails',array('id'=>$request->request->get('form')['uid'])));
//        $em = $this->getDoctrine()->getManager();
//

//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find Processanomalies entity.');
//        }
        $entity = $em->getRepository('AnomaliesBundle:Processanomalies')->find($id);        
        $form = $this->createForm(new ProcessanomaliesType($this->container), $entity);           
        $upform = $this->createForm(new DocumentsType());
//            
        $upform->handleRequest($request);
        $validator = $this->get('validator');
        $errors = $validator->validate($upform);    
//       
        if (count($errors) > 0) 
        {          
            return $this->render('AnomaliesBundle:Processanomalies:edit.html.php', array(
                                 'entity' => $entity,
                                 'form'   => $form->createView(),                
                                 'upform'   => $upform->createView(),
                                 'errors' => $errors
                ));
        }
        
        
        if(!empty($request->request->all()))
        {
//            $societe = $em->getRepository('AnomaliesBundle:Societes')->find($request->request->get('anomaliesbundle_processanomalies')['societecodsap']); 
//            //var_dump($societe);die();
//            if (!$societe) {
//                throw $this->createNotFoundException('Unable to find Societes entity.');
//            }
//
//            $datestring = $request->request->get('anomaliesbundle_processanomalies')['periode']['year']
//                         ."/".
//                         $request->request->get('anomaliesbundle_processanomalies')['periode']['month']
//                         ."/".
//                         $request->request->get('anomaliesbundle_processanomalies')['periode']['day'];
//            
//            $datesysteme = new \DateTime();
//            $periode = new \DateTime($datestring);
//
//            $entity->setDatesysteme($datesysteme);
//            $entity->setPeriode($periode);
//
//
//            $entity->setSocietecodsap($societe->getSocietecodsap());       
//            $entity->setNomsociete($societe->getNomsociete());
//
//            $entity->setTypesociete($request->request->get('anomaliesbundle_processanomalies')['typesociete']);
//
//            $entity->setComptablesenior($request->request->get('anomaliesbundle_processanomalies')['comptablesenior']);
//            $entity->setComptablemanageur($request->request->get('anomaliesbundle_processanomalies')['comptablemanageur']);       
//            $entity->setSite($request->request->get('anomaliesbundle_processanomalies')['site']);
//            $entity->setNaturerreur($request->request->get('anomaliesbundle_processanomalies')['naturerreur']);
//            $entity->setCompteimpacte($request->request->get('anomaliesbundle_processanomalies')['compteimpacte']);
//            $entity->setCyclebilan($request->request->get('anomaliesbundle_processanomalies')['cyclebilan']);
//            $entity->setConstat($request->request->get('anomaliesbundle_processanomalies')['constat']);
//            $entity->setTypologieanomalie($request->request->get('anomaliesbundle_processanomalies')['typologieanomalie']);
//            $entity->setQualificationerreur($request->request->get('anomaliesbundle_processanomalies')['qualificationerreur']);
//            $entity->setNiveaurisque($request->request->get('anomaliesbundle_processanomalies')['niveaurisque']);
//            $entity->setDepartement($request->request->get('anomaliesbundle_processanomalies')['departement']);
//            $entity->setActiondemande($request->request->get('anomaliesbundle_processanomalies')['actiondemande']);
//            //$entity->setStatus($request->request->get('form')['status']);
//            $entity->setStatus(1); 
            
                       //var_dump($_FILES); die();
                       
            ########################### START upload ################################# 
            ###########################################################################
            
            $fs = new Filesystem();  
           //var_dump($_FILES); die();
           
            if($request->files->get('anomaliesbundle_documents')['userfile'] != null)
            {


                     $uf = new UploadedFile($request->files->get('anomaliesbundle_documents')['userfile'], 
                                            $request->files->get('anomaliesbundle_documents')['userfile']->getClientOriginalName());

                     $target_dir = realpath($this->container->getParameter('kernel.root_dir').'/../web/bundles/anomalies/images/originals');
                     //$target_file = $target_dir ."/". basename($_FILES["userfile"]["name"]);
                     $target_file = $target_dir ."/".$request->files->get('anomaliesbundle_documents')['userfile']->getClientOriginalName();
                     //die($target_file);
                     $tmb_dir = realpath($this->container->getParameter('kernel.root_dir').'/../web/bundles/anomalies/images/thumbs');
                     $uploadOk = 1;

                     $imagefiletype = pathinfo($target_file, PATHINFO_EXTENSION);
                     $imagename = pathinfo($target_file, PATHINFO_FILENAME);
                     
                     //die($imagefiletype);
             // Check if image file is a actual image or fake image
             //        if ($request->request->get('updatedetails')) {
             //            
             //            $check = getimagesize($_FILES["userfile"]["tmp_name"]);
             //            
             //            if ($check !== false) {
             //                echo "File is an image - " . $check["mime"] . ".";
             //                $uploadOk = 1;
             //            } else {
             //                echo "File is not an image.";
             //                $uploadOk = 0;
             //            }
             //        }
             // Check if file already exists
                     
                     if (file_exists($target_file)) {
                         echo "Sorry, file already exists.";
                         $uploadOk = 0;
                     }
             // Check file size
//                     if ($request->files->get('anomaliesbundle_documents')['userfile']->getClientSize() > 500000) {
//                         echo "prea mare";die();
//                         $uploadOk = 0;
//                     }
                     
             // Allow certain file formats
//                     if (    $imagefiletype != "jpg" 
//                          && $imagefiletype != "png" 
//                          && $imagefiletype != "jpeg" 
//                          && $imagefiletype != "gif") {
//                         
//                         echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";die();
//
//                         $uploadOk = 0;
//                     }

                     
                     if ($uploadOk == 0) {
                         echo "Sorry, your file was not uploaded.";die();

                     } 
                     else 
                     {
                            //    move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)           
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
                             

//                             $statement = $this->getConn()->executeQuery('SELECT photoname, photoextension FROM ar_documents
//                                                                          WHERE id=?',array($request->request->get('form')['uid']));
                             
//                             $entity = $em->getRepository('AnomaliesBundle:Documents')->find($id);                            
//
//
//                             //var_dump($photo);die();
//                             if($photo['photoname'] != null){
//
//                                 $thumb_path = $tmb_dir."/".$photo['photoname'].".".$photo['photoextension'];
//                                 $img_path =  $target_dir."/".$photo['photoname'].".".$photo['photoextension'];
//                                 //unlink($img_path);
//                                 $fs->remove(array($img_path, $thumb_path));
//                             }
//
//                             $this->getConn()->update('user', 
//                                                       array('photoname' => $imagename,
//                                                             'photoextension'=>$imagefiletype), 
//                                                       array('id' => $request->request->get('form')['uid']));


 
                         } else {
                             echo "Sorry, there was an error uploading your file";
                             die();
                         }
                     }
            }           
           
            ########################### END upload #################################
            ########################################################################
            
//            
//            try{     
//
//                 $em->flush();
//
//            }
//            catch(Doctrine\ORM\ORMException $e)
//            {           
//
//                // $this->container->get('session')->getFlashBag()->add("error", "L'enregistrement existe déjà dans la base de données!");
//
//                 return $this->redirect($this->generateUrl('processanomalies_new'));
//            };
//
//
//             $this->container->get('session')->getFlashBag()->add("notice", "Enregistrement ajouté avec succès!"); 
             
                                             
        }
        return $this->redirect($this->generateUrl('processanomalies_edit', array('id' => $id)));    

    }
    
    ############################################# END UPDATE ###########################################
    ####################################################################################################  

################################# START upload ############################
###########################################################################
    public function deletedocumentAction($id, $did)
    {      
        $fs = new Filesystem();  

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AnomaliesBundle:Documents')->find($did);

        if (!$entity) 
        {
            throw $this->createNotFoundException('Unable to find entity.');
        }
        
        ################### NEEDS FURTHER ABSTRACTION!!!!!!!!!!!!!!!!!!!!!
        if(  
               is_file($this->container->getParameter('kernel.root_dir').'/../web/bundles/anomalies/images/thumbs/'.$entity->getName().".".$entity->getExtension())
            && is_file($this->container->getParameter('kernel.root_dir').'/../web/bundles/anomalies/images/originals/'.$entity->getName().".".$entity->getExtension())
        )
        {
            $target_dir = realpath($this->container->getParameter('kernel.root_dir').'/../web/bundles/anomalies/images/originals');
            $tmb_dir = realpath($this->container->getParameter('kernel.root_dir').'/../web/bundles/anomalies/images/thumbs');

            $thumb_path = $tmb_dir."/".$entity->getName().".".$entity->getExtension();
            $img_path =  $target_dir."/".$entity->getName().".".$entity->getExtension();

            //echivalent cu unlink($img_path);
            $fs->remove(array($img_path, $thumb_path));
        }
        elseif(is_file($this->container->getParameter('kernel.root_dir').'/../web/bundles/anomalies/documents/'.$entity->getName().".".$entity->getExtension()))
        {
            $target_dir = realpath($this->container->getParameter('kernel.root_dir').'/../web/bundles/anomalies/documents');

            $filepath =  $target_dir."/".$entity->getName().".".$entity->getExtension();

            //echivalent cu unlink($img_path);
            $fs->remove(array($filepath));         
        }

        //foreach($entity->getFkdocuments() as $doc)
        // $em->remove($doc);
        //$entity->setEnabled(0);  
        
        $em->remove($entity);
        $em->flush();
        
        return $this->redirect($this->generateUrl('processanomalies_edit', array('id' => $id)));    
    }

 ################################# START upload ############################
 ################### NEEDS FURTHER ABSTRACTION!!!!!!!!!!!!!!!!!!!!!
 ###########################################################################
    public function uploadAction(Request $request, $id)
    {      
//        echo "<pre>";
//        print_r($request);die();
        $em = $this->getDoctrine()->getManager();  
        
        $docsentity = new Documents();        
        $entity = $em->getRepository('AnomaliesBundle:Processanomalies')->find($id);    
        
        $form = $this->createForm(new ProcessanomaliesType($this->container), $entity);         
        
        $upform = $this->createForm(new DocumentsType(), $docsentity);
            
        $upform->handleRequest($request);
        $validator = $this->get('validator');
        
        $uperrors = $validator->validate($upform); 
        
       
        if (count($uperrors) > 0) 
        {          
            return $this->render('AnomaliesBundle:Processanomalies:edit.html.php', array(
                                 'entity' => $entity,
                                 'form'   => $form->createView(),                
                                 'upform'   => $upform->createView(),
                                 'uperrors' => $uperrors,
                                 'documents' => $entity->getFkdocuments()                
                ));
        }
        
       // var_dump($request->files);die();
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
                     $target_dir = realpath($this->container->getParameter('kernel.root_dir').'/../web/bundles/anomalies/images/originals');
                     //$target_file = $target_dir ."/". basename($_FILES["userfile"]["name"]);
                     $target_file = $target_dir ."/".$request->files->get('anomaliesbundle_documents')['userfile']->getClientOriginalName();
                     //die($target_file);
                     $tmb_dir = realpath($this->container->getParameter('kernel.root_dir').'/../web/bundles/anomalies/images/thumbs');
                     $uploadOk = 1;

                     $imagefiletype = pathinfo($target_file, PATHINFO_EXTENSION);
                     $imagename = pathinfo($target_file, PATHINFO_FILENAME);
                      
                     
                    // Check if file already exists                    
                    if (file_exists($target_file)) 
                    {
                        $this->container->get('session')->getFlashBag()->add("error", "Le fichier existe déjà.");                   
                        $uploadOk = 0;
                    }
                
                     
                    if ($uploadOk == 0) 
                    {
                        $this->container->get('session')->getFlashBag()->add("error", "Votre fichier n'a pas été téléchargé.");
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
                            $entity->getFkdocuments()->add($docsentity);
                            $docsentity->getProcessanomalies()->add($entity);

                            $em->persist($entity);
                            $em->persist($docsentity);
                            ####################### M<->M implemetare ########################     
                            
                            try
                            {     
                                 $em->flush();
                            }
                            catch(Doctrine\ORM\ORMException $e)
                            {           

                                //$this->container->get('session')->getFlashBag()->add("notice", "Fichier ajouté avec succès!"); 
                                return $this->redirect($this->generateUrl('processanomalies_edit', array('id' => $id)));   
                           }  
                           
                        } 
                        else 
                        {
                             $this->container->get('session')->getFlashBag()->add("error", "Une erreur s'est produite lors de l'envoi de votre fichier !");
                        }
                    }              
                }
                else
                {
                     $target_dir_documents = realpath($this->container->getParameter('kernel.root_dir').'/../web/bundles/anomalies/documents');
                     
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
                        $this->container->get('session')->getFlashBag()->add("error", "Le fichier existe déjà.");                   
                        $uploadOk = 0;
                    }
                
                     
                    if ($uploadOk == 0) 
                    {
                     //redirect aici cu mesaj in flashbag                        
                         //echo "Sorry, your file was not uploaded.";die();
                        $this->container->get('session')->getFlashBag()->add("error", "Votre fichier n'a pas été téléchargé.");
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
                            $entity->getFkdocuments()->add($docsentity);
                            $docsentity->getProcessanomalies()->add($entity);

                            $em->persist($entity);
                            $em->persist($docsentity);
                            ####################### M<->M implemetare ########################     
                            
                            try
                            {     
                                 $em->flush();
                            }
                            catch(Doctrine\ORM\ORMException $e)
                            {           
                                return $this->redirect($this->generateUrl('processanomalies_edit', array('id' => $id)));   
                           }  
                           
                        } else {

                             $this->container->get('session')->getFlashBag()->add("error", "Une erreur s'est produite lors de l'envoi de votre fichier !");

                        }
                    }                   
                    
                }   
            }
            else
            {
                $this->container->get('session')->getFlashBag()->add("error", "Vous devez sélectionner un fichier !");
            }
        }
        
        return $this->redirect($this->generateUrl('processanomalies_edit', array('id' => $id)));    
        
    }
    
 ################################# END upload ############################
 ###########################################################################    
    
 
}
