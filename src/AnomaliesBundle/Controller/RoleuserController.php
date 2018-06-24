<?php

namespace AnomaliesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

//importuri comune
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\EntityRepository;

use AnomaliesBundle\Entity\User;

use AnomaliesBundle\Form\RoleuserType;

class RoleuserController extends Controller
{
    public function indexAction()
    {
//        $user = $this->getUser();
//        var_dump($user->getRoles());die();
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AnomaliesBundle:User')->findBy(array('enabled'=>1));

        return $this->render('AnomaliesBundle:Roleuser:index.html.twig', array(
                             'entities' => $entities,
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
       //echo "<pre>";var_dump($request->request->get('anomaliesbundle_roleuser')['roles']);die(); 
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
            
         
            //$em->flush(); 
           // $eid = $entity->getId();
//        }
//        else
//        {           
//            $entity->setUsername($request->request->get('anomaliesbundle_roleuser')['username']);       
//           // $entity->setGivenname("ttt");
//            //$entity->setSurname("ttt");
//            $entity->setUsernameCanonical("ttt");
//            $entity->setEmail($request->request->get('anomaliesbundle_roleuser')['email']);       
//            $entity->setEmailCanonical(strtolower($request->request->get('anomaliesbundle_roleuser')['email']));
//            $entity->setEnabled(1);
//            $entity->setSalt("salt");
//            $entity->setPassword("");
//           // $entity->setLocked(0);
//            //$entity->setExpired(0);
//            //$entity->setCredentialsExpired(0);
//            //$entity->setDn("dn");  
//            //$entity->setDisplayname("ttt"); 
//            $entity->setRoles(array());       
//            $em->flush(); 
//           // $eid = $searchent->getId();
//        };
               

       // $user = $em->getRepository('AnomaliesBundle:User')->find($eid);   
//        if(isset($request->request->get('anomaliesbundle_roleuser')['roles']))
//        {   
//
//            $role = $request->request->get('anomaliesbundle_roleuser')['roles'];
//          // var_dump($user);die();
//            if ($role) {
//                $userRoles = $user->getRoles();
//                 //remove user roles
//                if(count($userRoles)){
//                    foreach ($userRoles as $role) {
//                        $user->removeRole($role);
//                    }
//                }
//
//                // add new roles 
//              //  foreach ($roles as $role) {
//                    $user->addRole($role);
//              //  }                   
//                //$user->setLocked(1);
//                //$em->persist($user);
//                //$em->flush();
//            }
//        }
//        else
//        {   
//            $userRoles = $user->getRoles();
//               //  remove user roles
//            if(count($userRoles)){
//                foreach ($userRoles as $role) 
//                {
//                    $user->removeRole($role);
//                }
//            
//            }
//            
//            $user->addRole('ROLE_USER_DEFAULT');
//            //$em->flush();
//        }

       // return $this->redirect($this->generateUrl('processanomalies_edit', array('id' => $entity->getId())));
        //return $this->redirect($this->generateUrl('roleuser'));
       
   
              
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
    
    
     /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editAction(User $roleuser)
    {        
         $editForm = $this->createForm(new RoleuserType(), $roleuser,  
                                  array(
                                        'roles' => $this->getRolesInSecurity(),
                                 ));  
        
        //Echivalenta cu varianta de mai sus
       // $editForm = $this->createForm('TvdamBundle\Form\ProductType', $product);
        
        //$editForm = $this->createUpdateForm($product);
      
        return $this->render('AnomaliesBundle:Roleuser:edit.html.twig', array(
            'entity' => $roleuser,
            'form'   => $editForm->createView(),
        ));
    }
    
    public function updateAction(Request $request, $id)
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
            return $this->render('AnomaliesBundle:Roleuser:edit.html.twig', array(
                'entity' => $entity,
                'form' => $form->createView(),
                'errors' => $errors
            ));
            
        }
     
        $em = $this->getDoctrine()->getManager();       
     
        $encoder = $this->get("security.password_encoder");
        $password = $encoder->encodePassword($entity, $request->request->get('anomaliesbundle_roleuser')['password']);
        $entity->setPassword($password);

        $entity->setUsername($request->request->get('anomaliesbundle_roleuser')['username']);       
       // $entity->setGivenname("ttt");
        //$entity->setSurname("ttt");
        $entity->setUsernameCanonical("ttt");
        $entity->setEmail($request->request->get('anomaliesbundle_roleuser')['email']);       
        $entity->setEmailCanonical(strtolower($request->request->get('anomaliesbundle_roleuser')['email']));
        $entity->setEnabled(1);
        $entity->setSalt(null);

       // $entity->setLocked(0);
        //$entity->setExpired(0);
        //$entity->setCredentialsExpired(0);
        //$entity->setDn("dn");  
        //$entity->setDisplayname("ttt"); 
        $entity->addRole($request->request->get('anomaliesbundle_roleuser')['roles']);         
//            $em->persist($entity);

        try{     
           $em->flush();
        }catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException  $e){           

           $this->container->get('session')->getFlashBag()->add("error", "L'enregistrement existe déjà dans la base de données!");

           return $this->redirect($this->generateUrl('roleuser_new'));
        };

        $this->container->get('session')->getFlashBag()->add("notice", "Enregistrement ajouté avec succès!"); 

        return $this->redirect($this->generateUrl('roleuser'));  
    }
    
    /**
     * Deletes a Typesociete entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {      
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AnomaliesBundle:Typesociete')->find($id);
                       
        try{    
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Typesociete entity.');
            }

        }catch(\Symfony\Component\HttpKernel\Exception\NotFoundHttpException  $e){           
            
            //Logare exceptie aici
            // $this->container->get('session')->getFlashBag()->add("error", "L'enregistrement existe déjà dans la base de données!");           
            //            echo "<pre>";
            //            print_r($e->getTraceAsString());
            //            die();
            return $this->redirect($this->generateUrl('typesociete'));
        };
        
        $entity->setEnabled(0);   
        //$em->remove($entity);
        $em->flush();
        
        return $this->redirect($this->generateUrl('typesociete'));
    }

}
