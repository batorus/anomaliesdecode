<?php

namespace AnomaliesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AnomaliesBundle\Entity\Risklevel;
use AnomaliesBundle\Form\RisklevelType;

/**
 * Risklevel controller.
 *
 */
class RisklevelController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AnomaliesBundle:Risklevel')->findBy(array('enabled'=>1));

        return $this->render('AnomaliesBundle:Risklevel:index.html.twig', array(
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
        $entity = new Risklevel();
        $form = $this->createForm(new RisklevelType(), $entity);
        
        return $this->render('AnomaliesBundle:Risklevel:new.html.twig', array(
                             'entity' => $entity,
                             'form'   => $form->createView(),
                            ));
//            return $this->render('AnomaliesBundle:Typecontrole:new.html.php', array(
//                         'entity' => $entity,
//                         'form'   => $form->createView(),
//                        ));
    }


    /**
     * Displays a form to edit an existing Risklevel entity.
     *
     */
    public function editAction(Risklevel $risklevel)
    {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('AnomaliesBundle:Risklevel')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find Risklevel entity.');
//        }
//
//        $editForm = $this->createEditForm($entity);
//        $deleteForm = $this->createDeleteForm($id);
//
//        return $this->render('AnomaliesBundle:Risklevel:edit.html.twig', array(
//            'entity'      => $entity,
//            'edit_form'   => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        ));
        
        
        $editForm = $this->createForm(new RisklevelType(), $risklevel);  
        
        //Echivalenta cu varianta de mai sus
       // $editForm = $this->createForm('TvdamBundle\Form\ProductType', $product);
        
        //$editForm = $this->createUpdateForm($product);
 
       
        return $this->render('AnomaliesBundle:Risklevel:edit.html.twig', array(
            'entity' => $risklevel,
            'form'   => $editForm->createView(),
        ));
    }


    /**
     * Edits an existing Risklevel entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('AnomaliesBundle:Risklevel')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find Risklevel entity.');
//        }
//
//        $deleteForm = $this->createDeleteForm($id);
//        $editForm = $this->createEditForm($entity);
//        $editForm->handleRequest($request);
//
//        if ($editForm->isValid()) {
//            $em->flush();
//
//            return $this->redirect($this->generateUrl('risklevel_edit', array('id' => $id)));
//        }
//
//        return $this->render('AnomaliesBundle:Risklevel:edit.html.twig', array(
//            'entity'      => $entity,
//            'edit_form'   => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        ));
        
        $em = $this->getDoctrine()->getManager();
       
        $entity = $em->getRepository('AnomaliesBundle:Risklevel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Typecontrole entity.');
        }
               
        $form = $this->createForm(new RisklevelType(), $entity);
              
        $form->handleRequest($request);
        $validator = $this->get('validator');
        $errors = $validator->validate($form);    
                
        if (count($errors) > 0) 
        {                     
           return $this->render('AnomaliesBundle:Risklevel:edit.html.twig', array(
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
        
        $entity->setRisklevel($request->request->get('anomaliesbundle_risklevel')['risklevel']);   
                
//        $em->persist($entity);

        try{     

             $em->flush();

        }catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException  $e){           

             $this->container->get('session')->getFlashBag()->add("error", "L'enregistrement existe déjà dans la base de données!");

             return $this->redirect($this->generateUrl('risklevel_new'));
        };


        $this->container->get('session')->getFlashBag()->add("notice", "Enregistrement ajouté avec succès!"); 

        return $this->redirect($this->generateUrl('risklevel'));          
                  
    }
    
    /**
     * Deletes a Risklevel entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
//        $form = $this->createDeleteForm($id);
//        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $entity = $em->getRepository('AnomaliesBundle:Risklevel')->find($id);
//
//            if (!$entity) {
//                throw $this->createNotFoundException('Unable to find Risklevel entity.');
//            }
//
//            $em->remove($entity);
//            $em->flush();
//        }
//
//        return $this->redirect($this->generateUrl('risklevel'));
        
        
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AnomaliesBundle:Risklevel')->find($id);
        
         try{     

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Risklevel entity.');
            };

        }catch(\Symfony\Component\HttpKernel\Exception\NotFoundHttpException  $e){           
            
            //Logare exceptie aici
            // $this->container->get('session')->getFlashBag()->add("error", "L'enregistrement existe déjà dans la base de données!");           
            //            echo "<pre>";
            //            print_r($e->getTraceAsString());
            //            die();
            return $this->redirect($this->generateUrl('risklevel'));
        };

       

        $entity->setEnabled(0);   
        //$em->remove($entity);
        $em->flush();
        
        return $this->redirect($this->generateUrl('risklevel'));
    }

   
}
