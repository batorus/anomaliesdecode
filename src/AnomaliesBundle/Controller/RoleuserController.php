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
    
    ########################################## Datele sunt trimise aici din New #####################
    public function createAction(Request $request)
    {
       echo "<pre>";var_dump($request->request->get('anomaliesbundle_roleuser')['roles']);die(); 
        $entity = new User();
          
        $form = $this->createForm(new RoleuserType(), $entity,  
                                  array(
                                        'roles' => array_keys($this->getParameter('security.role_hierarchy.roles')),
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
        $searchent = $em->getRepository('AnomaliesBundle:User')->findOneBy(array("username"=>$request->request->get('anomaliesbundle_roleuser')['username']));
        $eid = 0;    
        //echo "<pre>";var_dump($searchent);die();
        if(!$searchent)
        {            
            $entity->setUsername($request->request->get('anomaliesbundle_roleuser')['username']);       
           // $entity->setGivenname("ttt");
            //$entity->setSurname("ttt");
            $entity->setUsernameCanonical("ttt");
            $entity->setEmail($request->request->get('anomaliesbundle_roleuser')['email']);       
            $entity->setEmailCanonical(strtolower($request->request->get('anomaliesbundle_roleuser')['email']));
            $entity->setEnabled(1);
            $entity->setSalt("salt");
            $entity->setPassword("");
           // $entity->setLocked(0);
            //$entity->setExpired(0);
            //$entity->setCredentialsExpired(0);
            //$entity->setDn("dn");  
            //$entity->setDisplayname("ttt"); 
            $entity->setRoles(array());         
            $em->persist($entity);
            $em->flush(); 
            $eid = $entity->getId();
        }
        else
        {           
            $entity->setUsername($request->request->get('anomaliesbundle_roleuser')['username']);       
           // $entity->setGivenname("ttt");
            //$entity->setSurname("ttt");
            $entity->setUsernameCanonical("ttt");
            $entity->setEmail($request->request->get('anomaliesbundle_roleuser')['email']);       
            $entity->setEmailCanonical(strtolower($request->request->get('anomaliesbundle_roleuser')['email']));
            $entity->setEnabled(1);
            $entity->setSalt("salt");
            $entity->setPassword("");
           // $entity->setLocked(0);
            //$entity->setExpired(0);
            //$entity->setCredentialsExpired(0);
            //$entity->setDn("dn");  
            //$entity->setDisplayname("ttt"); 
            $entity->setRoles(array());       
            $em->flush(); 
            $eid = $searchent->getId();
        };
               

        $user = $em->getRepository('AnomaliesBundle:User')->find($eid);   
        if(isset($request->request->get('anomaliesbundle_roleuser')['roles']))
        {   

            $role = $request->request->get('anomaliesbundle_roleuser')['roles'];
          // var_dump($user);die();
            if ($user && $role) {
                //$userRoles = $user->getRoles();
                // remove user roles
//                if(count($userRoles)){
//                    foreach ($userRoles as $role) {
//                        $user->removeRole($role);
//                    }
//                }

                // add new roles 
              //  foreach ($roles as $role) {
                    $user->addRole($role);
              //  }                   
                //$user->setLocked(1);
                //$em->persist($user);
                $em->flush();
            }
        }
        else
        {   
            //$userRoles = $user->getRoles();
                // remove user roles
//            if(count($userRoles)){
//                foreach ($userRoles as $role) 
//                {
//                    $user->removeRole($role);
//                }
//            
//            }
            
            $user->addRole('ROLE_USER_DEFAULT');
            $em->flush();
        }

       // return $this->redirect($this->generateUrl('processanomalies_edit', array('id' => $entity->getId())));
        return $this->redirect($this->generateUrl('roleuser'));
       
//        try{     
//           
//           $em->flush();
//           
//        }catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException  $e){           
//            
//           $this->container->get('session')->getFlashBag()->add("error", "L'enregistrement existe déjà dans la base de données!");
//            
//           return $this->redirect($this->generateUrl('risklevel_new'));
//        };
//              
//        $this->container->get('session')->getFlashBag()->add("notice", "Enregistrement ajouté avec succès!"); 
//        
//        return $this->redirect($this->generateUrl('risklevel'));    
              
    }

    #################################### NEW FORM #############################
    public function newAction()
    {    
        //var_dump($this->getParameter('security.role_hierarchy.roles'));die;
        
        $rolesarray = array();
        foreach (array_keys($this->getParameter('security.role_hierarchy.roles')) as $value)
            $rolesarray[$value] = $value;
        
        $entity = new User();
        $form = $this->createForm(new RoleuserType(), $entity,  
                                  array(
                                        'roles' => $rolesarray,
                                 ));
        
        return $this->render('AnomaliesBundle:Roleuser:new.html.twig', array(
                             'entity' => $entity,
                             'form'   => $form->createView(),
                            ));

    }
}
