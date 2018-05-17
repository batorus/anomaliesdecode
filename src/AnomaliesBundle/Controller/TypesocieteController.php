<?php

namespace AnomaliesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AnomaliesBundle\Entity\Typesociete;
use AnomaliesBundle\Form\TypesocieteType;

/**
 * Typesociete controller.
 *
 */
class TypesocieteController extends Controller
{

    /**
     * Lists all Typesociete entities.
     *
     */
    public function indexAction()
    {      
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AnomaliesBundle:Typesociete')->findBy(array('enabled'=>1));

        return $this->render('AnomaliesBundle:Typesociete:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    
    /**
     * Creates a new Typesociete entity.
     *
     */
    public function createAction(Request $request)
    {
           
        $entity = new Typesociete();
          
        $form = $this->createForm(new TypesocieteType(), $entity);
        
        $form->handleRequest($request);
        
        $validator = $this->get('validator');
        $errors = $validator->validate($form);    
                
        if (count($errors) > 0) 
        {          
           
            return $this->render('AnomaliesBundle:Typesociete:new.html.twig', array(
                'entity' => $entity,
                'form' => $form->createView()
            ));
            
//            return $this->render('AnomaliesBundle:Typecontrole:new.html.php', array(
//                'entity' => $entity,
//                'form' => $form->createView()
//            ));
        }
     
        $em = $this->getDoctrine()->getManager();
        $entity->setTypesociete($request->request->get('anomaliesbundle_typesociete')['typesociete']);   
        $entity->setEnabled(1);
        $em->persist($entity);
       
        try{     
           
           $em->flush();
           
        }catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException  $e){           
            
           $this->container->get('session')->getFlashBag()->add("error", "L'enregistrement existe déjà dans la base de données!");
            
           return $this->redirect($this->generateUrl('typesociete_new'));
        };
              
        $this->container->get('session')->getFlashBag()->add("notice", "Enregistrement ajouté avec succès!"); 
        
        return $this->redirect($this->generateUrl('typesociete'));     
        
    }

   
    

    /**
     * Displays a form to create a new Typesociete entity.
     *
     */
    public function newAction()
    {
      
        $entity = new Typesociete();

        $form = $this->createForm(new TypesocieteType(), $entity);
        
        return $this->render('AnomaliesBundle:Typesociete:new.html.twig', array(
                             'entity' => $entity,
                             'form'   => $form->createView(),
                            ));        
    }
    
   

    /**
     * Displays a form to edit an existing Typesociete entity.
     *
     */
    public function editAction(Typesociete $typesociete)
    {        
         $editForm = $this->createForm(new TypesocieteType(), $typesociete);  
        
        //Echivalenta cu varianta de mai sus
       // $editForm = $this->createForm('TvdamBundle\Form\ProductType', $product);
        
        //$editForm = $this->createUpdateForm($product);
      
        return $this->render('AnomaliesBundle:Typesociete:edit.html.twig', array(
            'entity' => $typesociete,
            'form'   => $editForm->createView(),
        ));
    }


    /**
     * Edits an existing Typesociete entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
       $em = $this->getDoctrine()->getManager();
       
        $entity = $em->getRepository('AnomaliesBundle:Typesociete')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Typesociete entity.');
        }
               
        $form = $this->createForm(new TypesocieteType(), $entity);
              
        $form->handleRequest($request);
        $validator = $this->get('validator');
        $errors = $validator->validate($form);    
                
        if (count($errors) > 0) 
        {                     
           return $this->render('AnomaliesBundle:Typesociete:edit.html.twig', array(
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
        
        $entity->setTypesociete($request->request->get('anomaliesbundle_typesociete')['typesociete']);   
                
//        $em->persist($entity);

        try{     

             $em->flush();

        }catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException  $e){           

             $this->container->get('session')->getFlashBag()->add("error", "L'enregistrement existe déjà dans la base de données!");

             return $this->redirect($this->generateUrl('typesociete_new'));
        };


        $this->container->get('session')->getFlashBag()->add("notice", "Enregistrement ajouté avec succès!"); 

        return $this->redirect($this->generateUrl('typesociete'));  
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
