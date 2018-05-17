<?php

namespace AnomaliesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AnomaliesBundle\Entity\Typetaches;
use AnomaliesBundle\Form\TypetachesType;

/**
 * Typetaches controller.
 *
 */
class TypetachesController extends Controller
{

    /**
     * Lists all Typetaches entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AnomaliesBundle:Typetaches')->findBy(array('enabled'=>1));

        return $this->render('AnomaliesBundle:Typetaches:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Typetaches entity.
     *
     */
    public function createAction(Request $request)
    {
            
        $entity = new Typetaches();
          
        $form = $this->createForm(new TypetachesType(), $entity);
        
        $form->handleRequest($request);
        
        $validator = $this->get('validator');
        $errors = $validator->validate($form);    
                
        if (count($errors) > 0) 
        {          
           
            return $this->render('AnomaliesBundle:Typetaches:new.html.twig', array(
                'entity' => $entity,
                'form' => $form->createView()
            ));
            
//            return $this->render('AnomaliesBundle:Typecontrole:new.html.php', array(
//                'entity' => $entity,
//                'form' => $form->createView()
//            ));
        }
     
        $em = $this->getDoctrine()->getManager();
        $entity->setTypetache($request->request->get('anomaliesbundle_typetaches')['typetache']);   
        $entity->setEnabled(1);
        $em->persist($entity);
       
        try{     
           
           $em->flush();
           
        }catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException  $e){           
            
           $this->container->get('session')->getFlashBag()->add("error", "L'enregistrement existe déjà dans la base de données!");
            
           return $this->redirect($this->generateUrl('typetaches_new'));
        };
              
        $this->container->get('session')->getFlashBag()->add("notice", "Enregistrement ajouté avec succès!"); 
        
        return $this->redirect($this->generateUrl('typetaches'));     
    }

   

    /**
     * Displays a form to create a new Typetaches entity.
     *
     */
    public function newAction()
    {
        $entity = new Typetaches();

        $form = $this->createForm(new TypetachesType(), $entity);

        return $this->render('AnomaliesBundle:Typetaches:new.html.twig', array(
                             'entity' => $entity,
                             'form'   => $form->createView(),
                            ));    
    }

    
    /**
     * Displays a form to edit an existing Typetaches entity.
     *
     */
    public function editAction(Typetaches $typetaches)
    {

        $editForm = $this->createForm(new TypetachesType(), $typetaches);  
        
        //Echivalenta cu varianta de mai sus
       // $editForm = $this->createForm('TvdamBundle\Form\ProductType', $product);
        
        //$editForm = $this->createUpdateForm($product);
      
        return $this->render('AnomaliesBundle:Typetaches:edit.html.twig', array(
            'entity' => $typetaches,
            'form'   => $editForm->createView(),
        ));    
    }


    /**
     * Edits an existing Typetaches entity.
     *
     */
    public function updateAction(Request $request, $id)
    {    
        $em = $this->getDoctrine()->getManager();
       
        $entity = $em->getRepository('AnomaliesBundle:Typetaches')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Typetaches entity.');
        }
               
        $form = $this->createForm(new TypetachesType(), $entity);
              
        $form->handleRequest($request);
        $validator = $this->get('validator');
        $errors = $validator->validate($form);    
                
        if (count($errors) > 0) 
        {                     
           return $this->render('AnomaliesBundle:Typetaches:edit.html.twig', array(
                                'entity' => $entity,
                                'form'   => $form->createView(),
                                'errors' => $errors
            ));
            
//            return $this->render('AnomaliesBundle:Typecontrole:edit.html.php', array(
//                     'entity' => $entity,
//                     'form'   => $form->createView(),
//                     'errors' => $errors
//            ));
        }
        
        $entity->setTypetache($request->request->get('anomaliesbundle_typetaches')['typetache']);   
                
//        $em->persist($entity);

        try{     

             $em->flush();

        }catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException  $e){           

             $this->container->get('session')->getFlashBag()->add("error", "L'enregistrement existe déjà dans la base de données!");

             return $this->redirect($this->generateUrl('typetaches_new'));
        };


        $this->container->get('session')->getFlashBag()->add("notice", "Enregistrement ajouté avec succès!"); 

        return $this->redirect($this->generateUrl('typetaches'));  
    }
    /**
     * Deletes a Typetaches entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AnomaliesBundle:Typetaches')->find($id);
                       
        try{    
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Typetaches entity.');
            }

        }catch(\Symfony\Component\HttpKernel\Exception\NotFoundHttpException  $e){           
            
            //Logare exceptie aici
            // $this->container->get('session')->getFlashBag()->add("error", "L'enregistrement existe déjà dans la base de données!");           
            //            echo "<pre>";
            //            print_r($e->getTraceAsString());
            //            die();
            return $this->redirect($this->generateUrl('typetaches'));
        };
        
        $entity->setEnabled(0);   
        //$em->remove($entity);
        $em->flush();
        
        return $this->redirect($this->generateUrl('typetaches'));
    }
}
