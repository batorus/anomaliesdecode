<?php

namespace AnomaliesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

//importuri comune
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpFoundation\Session\Session;
//use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\EntityRepository;

use AnomaliesBundle\Entity\User;
use AnomaliesBundle\Entity\Documents;
use AnomaliesBundle\Form\RoleuserType;
use AnomaliesBundle\Form\DocumentsType;

use AnomaliesBundle\Services\FileUploader;
class RoleuserController extends Controller
{
    public function indexAction(Request $request)
    {
//        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
  
        

        $query = $em->getRepository('AnomaliesBundle:User')->findBy(array('enabled'=>1));
        
        $paginator  = $this->get('knp_paginator');
        
        $pagination = $paginator->paginate(
                        $query, /* query NOT result */
                        $request->query->getInt('page', 1)/*page number*/,
                        6/*limit per page*/
        );


        return $this->render('AnomaliesBundle:Roleuser:index.html.twig', array(
                             'entities' => $pagination,
                             //'pagination' => $pagination,
                            ));
    }
    
    public function getRolesInSecurity(){
        $rolesarray = array();
        foreach (array_keys($this->getParameter('security.role_hierarchy.roles')) as $value)
            $rolesarray[$value] = $value;
        
        return $rolesarray;
    }
    
    ########################################## Datele sunt trimise aici din New #####################
    public function createAction(Request $request)
    {
            
        $entity = new User();
            
        $form = $this->createForm(new RoleuserType(), $entity,  
                                  array(
                                        'roles' => $this->getRolesInSecurity(),
                                 ));
        
        $form->handleRequest($request);
        
        $validator = $this->get('validator');
        $errors = $validator->validate($form);   

            
            if (count($errors) > 0) 
            {                    
                return $this->render('AnomaliesBundle:Roleuser:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                    'errors' => $errors
                ));           
            }
      
            $em = $this->getDoctrine()->getManager();       
 
        
            $encoder = $this->get("security.password_encoder");
            $password = $encoder->encodePassword($entity, $request->request->get('anomaliesbundle_roleuser')['password']);

            $entity->setUsername($request->request->get('anomaliesbundle_roleuser')['username']);       
           // $entity->setGivenname("ttt");
            //$entity->setSurname("ttt");
            $entity->setUsernameCanonical("ttt");
            $entity->setEmail($request->request->get('anomaliesbundle_roleuser')['email']);       
            $entity->setEmailCanonical(strtolower($request->request->get('anomaliesbundle_roleuser')['email']));
            $entity->setEnabled(1);
            $entity->setSalt(null);
            $entity->setPassword($password);
           // $entity->setLocked(0);
            //$entity->setExpired(0);
            //$entity->setCredentialsExpired(0);
            //$entity->setDn("dn");  
            //$entity->setDisplayname("ttt"); 
            $entity->addRole($request->request->get('anomaliesbundle_roleuser')['roles']);         
            $em->persist($entity);
            
            try{     

               $em->flush();

            }catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException  $e){           

               $this->container->get('session')->getFlashBag()->add("error", "L'enregistrement existe déjà dans la base de données!");

               return $this->redirect($this->generateUrl('roleuser_new'));
            };

            $this->container->get('session')->getFlashBag()->add("notice", "Enregistrement ajouté avec succès!"); 

            return $this->redirect($this->generateUrl('roleuser')); 
 
    }

    #################################### NEW FORM #############################
    public function newAction()
    {      
        $entity = new User();
        $form = $this->createForm(new RoleuserType(), $entity,  
                                  array(
                                        'roles' => $this->getRolesInSecurity(),
                                 ));
        
        return $this->render('AnomaliesBundle:Roleuser:new.html.twig', array(
                             'entity' => $entity,
                             'form'   => $form->createView(),
                            ));
    }
    
    
    public function purgeRoles(Request $request, User $user){
        $userRoles = $user->getRoles();


        if(count($userRoles)){
            foreach ($userRoles as $role) {
                $user->removeRole($role);
            }
        }
    }
    
     /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editAction(User $roleuser)
    {      
         $em = $this->getDoctrine()->getManager();
         $editForm = $this->createForm(new RoleuserType(), $roleuser,  
                                  array(
                                        'roles' => $this->getRolesInSecurity(),
                                 )); 
         
        $uploadForm = $this->createForm(new DocumentsType(), new Documents());
        

        $documents = $roleuser->getDocuments();
        if (!$documents) {
            throw $this->createNotFoundException('Unable to find Documents entity.');
        }
        
        $docs = array();
        foreach($documents as $document){
            if($document->getEnabled()==1){
                $docs[] = $document;
            }
        }        

    
        return $this->render('AnomaliesBundle:Roleuser:edit.html.twig', array(
            'entity' => $roleuser,
            'documents'=>$docs,
            'form'   => $editForm->createView(),
            "uploadForm" =>$uploadForm->createView() 
        ));
    }
    

    
    public function updateAction(Request $request, $id)
    { 
        $em = $this->getDoctrine()->getManager();
       
        $entity = $em->getRepository('AnomaliesBundle:User')->find($id);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        
        $documents = $entity->getDocuments();
        if (!$documents) {
            throw $this->createNotFoundException('Unable to find Documents entity.');
        }
        
        $docs = array();
        foreach($documents as $document){
            if($document->getEnabled()==1){
                $docs[] = $document;
            }
        }
                   
        $form = $this->createForm(new RoleuserType(), $entity,  
                                  array(
                                        'roles' => $this->getRolesInSecurity(),
                                 ));
        
        $uploadForm = $this->createForm(new DocumentsType(), new Documents());
        
        $form->handleRequest($request);
       
        $validator = $this->get('validator');

            $errors = $validator->validate($form);    
            if (count($errors) > 0) 
            {                    
                return $this->render('AnomaliesBundle:Roleuser:edit.html.twig', array(
                    'entity' => $entity,
                    'documents'=>$docs,
                    'form' => $form->createView(),
                    'uploadForm'=>$uploadForm->createView(),
                    'errors' => $errors
                ));

            }


            $entity->setUsername($request->request->get('anomaliesbundle_roleuser')['username']);       
           // $entity->setGivenname("ttt");
            //$entity->setSurname("ttt");
            $entity->setUsernameCanonical("ttt");
            $entity->setEmail($request->request->get('anomaliesbundle_roleuser')['email']);       
            $entity->setEmailCanonical(strtolower($request->request->get('anomaliesbundle_roleuser')['email']));
            $entity->setEnabled(1);
            $entity->setSalt(null);

            if(!empty($request->request->get('anomaliesbundle_roleuser')['password'])){
                //die("not empty");
                $encoder = $this->get("security.password_encoder");
                $password = $encoder->encodePassword($entity, $request->request->get('anomaliesbundle_roleuser')['password']);
                $entity->setPassword($password);
            }
           // $entity->setLocked(0);
            //$entity->setExpired(0);
            //$entity->setCredentialsExpired(0);
            //$entity->setDn("dn");  
            //$entity->setDisplayname("ttt"); 
            $this->purgeRoles($request, $entity);
            $entity->addRole($request->request->get('anomaliesbundle_roleuser')['roles']);         

            try{     
               $em->flush();
            }catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException  $e){           

               $this->container->get('session')->getFlashBag()->add("error", "L'enregistrement existe déjà dans la base de données!");

               return $this->redirect($this->generateUrl('roleuser_new'));
            };

            $this->container->get('session')->getFlashBag()->add("notice", "Enregistrement ajouté avec succès!"); 

            return $this->redirect($this->generateUrl('roleuser'));          
     
    }
    
    
    public function uploadAction(Request $request, $id)
    { 
//        $em = $this->getDoctrine()->getManager();
//       
//        $entity = $em->getRepository('AnomaliesBundle:User')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find User entity.');
//        }
//      
//        //$documents = $em->getRepository('AnomaliesBundle:Documents')->getRecords($id);
//        $documents = $entity->getDocuments();
//        if (!$documents) {
//            throw $this->createNotFoundException('Unable to find Documents entity.');
//        }
//        
//        $docs = array();
//        foreach($documents as $document){
//            if($document->getEnabled()==1){
//                $docs[] = $document;
//            }
//        }
//            
//        $form = $this->createForm(new RoleuserType(), $entity,  
//                                  array(
//                                        'roles' => $this->getRolesInSecurity(),
//                                 ));
//        
//        $uploadForm = $this->createForm(new DocumentsType(), new Documents());      
//        $uploadForm->handleRequest($request);
//        
//        $validator = $this->get('validator');
//        $errors = $validator->validate($uploadForm);  
//           
//        if (count($errors) > 0) 
//        {                    
//            return $this->render('AnomaliesBundle:Roleuser:edit.html.twig', array(
//                'entity' => $entity,
//                'documents'=>$docs,                
//                'form' => $form->createView(),
//                'uploadForm'=>$uploadForm->createView(),
//                'errors' => $errors
//            ));
//
//        }
        $em = $this->getDoctrine()->getManager(); 
        //Upload the file here
        (new FileUploader($request, $em, $this->container))->uploadAction($id);

        return $this->redirectToRoute('roleuser_edit',array('id'=>$id));
    } 
    
    
    public function updatedocumentAction(Request $request, $did, $id)
    {   
        $em = $this->getDoctrine()->getManager();
        (new FileUploader($request, $em, $this->container))->updatedocumentAction($did);
        return $this->redirectToRoute('roleuser_edit',array('id'=>$id));
    }
    
    public function deletedocumentAction(Request $request, $did, $id)
    {   
        $em = $this->getDoctrine()->getManager();
        (new FileUploader($request, $em, $this->container))->deletedocumentAction($did);
        return $this->redirectToRoute('roleuser_edit',array('id'=>$id));
    }   
    

    public function deleteAction(Request $request, $id)
    {      
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AnomaliesBundle:User')->find($id);
                       
        try{    
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }

        }catch(\Symfony\Component\HttpKernel\Exception\NotFoundHttpException  $e){           
            
            //Logare exceptie aici
            // $this->container->get('session')->getFlashBag()->add("error", "L'enregistrement existe déjà dans la base de données!");           
            //            echo "<pre>";
            //            print_r($e->getTraceAsString());
            //            die();
            return $this->redirect($this->generateUrl('roleuser'));
        };
        
        $entity->setEnabled(0);   
        //$em->remove($entity);
        $em->flush();
        
        return $this->redirect($this->generateUrl('roleuser'));
    }

}
