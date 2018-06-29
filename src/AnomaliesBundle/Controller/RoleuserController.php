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
//        var_dump($user->getRoles());die();
        $em = $this->getDoctrine()->getManager();
        
//        $sql = "SELECT * FROM ar_user u";
//        $stmt = $em->prepare($sql);
//        $stmt->execute();
//        $query = $stmt->fetchAll();
//        
//        $queryBuilder = $em->getRepository('AnomaliesBundle:User')
//                           ->createQueryBuilder('u')
//                           //->select("u.id","u.username","u.email","u.roles","u.enabled")
//                           ->andWhere('u.enabled = :enabled')
//                           ->addSelect("u.id","u.username","u.email","u.roles","u.enabled")
//                           ->setParameter('enabled', '1');
//        $query = $queryBuilder->getQuery()->execute();
        
//        $query = $em->createQuery('SELECT u.id,u.username,u.email,u.roles,u.enabled FROM AnomaliesBundle\Entity\User u');
//        $users = $query->getResult();    
        

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
      //  print_r($_FILES);
       //echo "<pre>";
       //var_dump($request->files->get('anomaliesbundle_roleuser')['documents']['userfile']);
       //var_dump($request->request->get('anomaliesbundle_roleuser'));
       //die(); 
              
        $entity = new User();
            
        $form = $this->createForm(new RoleuserType(), $entity,  
                                  array(
                                        'roles' => $this->getRolesInSecurity(),
                                 ));
        
        $form->handleRequest($request);
        
        $validator = $this->get('validator');
        $errors = $validator->validate($form);   
        
       // var_dump($request->files->get('anomaliesbundle_roleuser')['documents']);die();
     //  $errors = $validator->validatePropertyValue(new Documents(),'userfile', $request->request->get('anomaliesbundle_roleuser')['documents']['description']);
           
//               if($form->get('save')->isClicked()){
//                die("save");  }
//                if($form->get('documents')->get('upload')->isClicked()){
//                die("upload");  } 
    //   echo "<pre>";
      // print_r($form->getData());
     // print_r(count($errors));die();
        
       // if($form->get('save')->isClicked()){
            
            if (count($errors) > 0) 
            {                    
                return $this->render('AnomaliesBundle:Roleuser:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                    'errors' => $errors
                ));           
            }
      
            $em = $this->getDoctrine()->getManager();       
            //$user = $em->getRepository('AnomaliesBundle:User')->findOneBy(array("username"=>$request->request->get('anomaliesbundle_roleuser')['username']));
            //$eid = 0;    
            //echo "<pre>";var_dump($searchent);die();

    //        if(!$user)
    //        {  
        
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
      //  }     
       // elseif($form->get('documents')->get('upload')->isClicked()){
                       
//            var_dump($request->request->get('anomaliesbundle_roleuser')['documents']['description']);
//            var_dump($request->files->get('anomaliesbundle_roleuser')['documents']['userfile']);
//            die();
            
       // }
        
    //    return $this->redirect($this->generateUrl('roleuser')); 
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
          // var_dump($userRoles);die();

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
        
        $criteria = new \Doctrine\Common\Collections\Criteria();               
        $criteria->where($criteria->expr()->eq("enabled", 1));
        
      //  $documents = $em->getRepository('AnomaliesBundle:Documents')->findBy(array('user_id'=>$roleuser->getId()));
       // dump($roleuser->getId());die();
         //$documents = $em->getRepository('AnomaliesBundle:Documents')->find($roleuser->getId());     
        $documents = $roleuser->getDocuments();
        if (!$documents) {
            throw $this->createNotFoundException('Unable to find Documents entity.');
        }
        
        //Echivalenta cu varianta de mai sus
       // $editForm = $this->createForm('TvdamBundle\Form\ProductType', $product);

      
        return $this->render('AnomaliesBundle:Roleuser:edit.html.twig', array(
            'entity' => $roleuser,
            'documents'=>$documents,
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
        
       // $documents = $em->getRepository('AnomaliesBundle:Documents')->findBy(array('user_id'=>$id),array('enabled'=>1));
        $documents = $entity->getDocuments();
        if (!$documents) {
            throw $this->createNotFoundException('Unable to find Documents entity.');
        }
                   
        $form = $this->createForm(new RoleuserType(), $entity,  
                                  array(
                                        'roles' => $this->getRolesInSecurity(),
                                 ));
        
        $uploadForm = $this->createForm(new DocumentsType(), new Documents());
        
        $form->handleRequest($request);
      //  $uploadForm->handleRequest($request);
       
        $validator = $this->get('validator');

            
       // if($form->get('save')->isClicked()){
       // die("ss");
            $errors = $validator->validate($form);    
            if (count($errors) > 0) 
            {                    
                return $this->render('AnomaliesBundle:Roleuser:edit.html.twig', array(
                    'entity' => $entity,
                    'documents'=>$documents,
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
//        }
//        elseif($uploadForm->get('upload')->isClicked())
//        {
//            $errors = $validator->validate($uploadForm);    
//            if (count($errors) > 0) 
//            {                    
//                return $this->render('AnomaliesBundle:Roleuser:edit.html.twig', array(
//                    'entity' => $entity,
//                    'form' => $form->createView(),
//                    'uploadForm'=>$uploadForm->createView(),
//                    'errors' => $errors
//                ));
//
//            }
//           var_dump($request->request->get('anomaliesbundle_roleuser'));
//           var_dump($request->files->get('anomaliesbundle_roleuser')['userfile']);
//            die();
//        }
//        
//       return $this->redirect($this->generateUrl('roleuser'));        
    }
    
    
    public function uploadAction(Request $request, $id)
    { 
        $em = $this->getDoctrine()->getManager();
       
        $entity = $em->getRepository('AnomaliesBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        
       // $documents = $em->getRepository('AnomaliesBundle:Documents')->findBy(array('user_id'=>$id),array('enabled'=>1));
        $documents = $entity->getDocuments();
        if (!$documents) {
            throw $this->createNotFoundException('Unable to find Documents entity.');
        }
            
        $form = $this->createForm(new RoleuserType(), $entity,  
                                  array(
                                        'roles' => $this->getRolesInSecurity(),
                                 ));
        
        $uploadForm = $this->createForm(new DocumentsType(), new Documents());      
        $uploadForm->handleRequest($request);
        
        $validator = $this->get('validator');
        $errors = $validator->validate($uploadForm);  
        
        if (count($errors) > 0) 
        {                    
            return $this->render('AnomaliesBundle:Roleuser:edit.html.twig', array(
                'entity' => $entity,
                'documents'=>$documents,                
                'form' => $form->createView(),
                'uploadForm'=>$uploadForm->createView(),
                'errors' => $errors
            ));

        }
 
//           var_dump($request->request->get('anomaliesbundle_documents'));
//           var_dump($request->files->get('anomaliesbundle_documents')['userfile']);
//            die();        
        (new FileUploader())->uploadAction($request, $id, $em, $this->container);
        
        return $this->redirectToRoute('roleuser_update',array('id'=>$id));
    }   
    
    public function deletedocumentAction(Request $request, $id, $did)
    {
        //apel stergere aici
        return $this->redirectToRoute('roleuser_update',array('id'=>$id));
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
