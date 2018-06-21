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

        $entity = new Risklevel();
          
        $form = $this->createForm(new RisklevelType(), $entity);
        
        $form->handleRequest($request);
        
        $validator = $this->get('validator');
        $errors = $validator->validate($form);    
                
        if (count($errors) > 0) 
        {          
           
            return $this->render('AnomaliesBundle:Risklevel:new.html.twig', array(
                'entity' => $entity,
                'form' => $form->createView()
            ));
            
//            return $this->render('AnomaliesBundle:Typecontrole:new.html.php', array(
//                'entity' => $entity,
//                'form' => $form->createView()
//            ));
        }
     
        $em = $this->getDoctrine()->getManager();
        $entity->setRisklevel($request->request->get('anomaliesbundle_risklevel')['risklevel']);   
        $entity->setEnabled(1);
        $em->persist($entity);
       
        try{     
           
           $em->flush();
           
        }catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException  $e){           
            
           $this->container->get('session')->getFlashBag()->add("error", "L'enregistrement existe déjà dans la base de données!");
            
           return $this->redirect($this->generateUrl('risklevel_new'));
        };
              
        $this->container->get('session')->getFlashBag()->add("notice", "Enregistrement ajouté avec succès!"); 
        
        return $this->redirect($this->generateUrl('risklevel'));    
              
    }

    #################################### NEW FORM #############################
    public function newAction()
    {    
        //var_dump($this->getParameter('security.role_hierarchy.roles'));die;
        $entity = new User();
        $form = $this->createForm(new RoleuserType(), $entity,  
                                  array(
                                        'roles' => array_keys($this->getParameter('security.role_hierarchy.roles')),
                                 ));
        
        return $this->render('AnomaliesBundle:Roleuser:new.html.twig', array(
                             'entity' => $entity,
                             'form'   => $form->createView(),
                            ));

    }
}
