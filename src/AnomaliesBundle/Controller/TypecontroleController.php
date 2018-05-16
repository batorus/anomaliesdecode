<?php

namespace AnomaliesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AnomaliesBundle\Entity\Typecontrole;
use AnomaliesBundle\Form\TypecontroleType;

/**
 * Typecontrole controller.
 *
 */
class TypecontroleController extends Controller
{

    /**
     * Lists all Typecontrole entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AnomaliesBundle:Typecontrole')->findBy(array('enabled'=>1));

        return $this->render('AnomaliesBundle:Typecontrole:index.html.twig', array(
            'entities' => $entities,
        ));
        
//        return $this->render('AnomaliesBundle:Typecontrole:index.html.php', array(
//            'entities' => $entities,
//        ));
    }
    
    
    
    
    /**
     * Creates a new Typecontrole entity.
     *
     */
    public function createAction(Request $request)
    {
       $entity = new Typecontrole();
          
        $form = $this->createForm(new TypecontroleType(), $entity);
        
        $form->handleRequest($request);
        
        $validator = $this->get('validator');
        $errors = $validator->validate($form);    
                
        if (count($errors) > 0) 
        {          
           
            return $this->render('AnomaliesBundle:Typecontrole:new.html.twig', array(
                'entity' => $entity,
                'form' => $form->createView()
            ));
            
//            return $this->render('AnomaliesBundle:Typecontrole:new.html.php', array(
//                'entity' => $entity,
//                'form' => $form->createView()
//            ));
        }
     
        $em = $this->getDoctrine()->getManager();
        $entity->setTypecontrole($request->request->get('anomaliesbundle_typecontrole')['typecontrole']);   
        $entity->setEnabled(1);
        $em->persist($entity);
       
        try{     
           
           $em->flush();
           
        }catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException  $e){           
            
           $this->container->get('session')->getFlashBag()->add("error", "L'enregistrement existe déjà dans la base de données!");
            
           return $this->redirect($this->generateUrl('typecontrole_new'));
        };
              
        $this->container->get('session')->getFlashBag()->add("notice", "Enregistrement ajouté avec succès!"); 
        
        return $this->redirect($this->generateUrl('typecontrole'));              
    }

    

    /**
     * Displays a form to create a new Typecontrole entity.
     *
     */
    public function newAction()
    {
        $entity = new Typecontrole();

        $form = $this->createForm(new TypecontroleType(), $entity);
        
        return $this->render('AnomaliesBundle:Typecontrole:new.html.twig', array(
                             'entity' => $entity,
                             'form'   => $form->createView(),
                            ));
//            return $this->render('AnomaliesBundle:Typecontrole:new.html.php', array(
//                         'entity' => $entity,
//                         'form'   => $form->createView(),
//                        ));
    }

   

    /**
     * Displays a form to edit an existing Typecontrole entity.
     *
     */
    public function editAction(Typecontrole $typecontrole)
    {
         
        $editForm = $this->createForm(new TypecontroleType(), $typecontrole);  
        
        //Echivalenta cu varianta de mai sus
       // $editForm = $this->createForm('TvdamBundle\Form\ProductType', $product);
        
        //$editForm = $this->createUpdateForm($product);
 
       
        return $this->render('AnomaliesBundle:Typecontrole:edit.html.twig', array(
            'entity' => $typecontrole,
            'form'   => $editForm->createView(),
        ));
    }

  
    /**
     * Edits an existing Typecontrole entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
       
        $entity = $em->getRepository('AnomaliesBundle:Typecontrole')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Typecontrole entity.');
        }
               
        $form = $this->createForm(new TypecontroleType(), $entity);
              
        $form->handleRequest($request);
        $validator = $this->get('validator');
        $errors = $validator->validate($form);    
                
        if (count($errors) > 0) 
        {                     
//           return $this->render('AnomaliesBundle:Typetache:edit.html.twig', array(
//                                'typetaches' => $entity,
//                                'form'   => $form->createView(),
//                                'errors' => $errors
//            ));
            
            return $this->render('AnomaliesBundle:Typecontrole:edit.html.php', array(
                     'entity' => $entity,
                     'form'   => $form->createView(),
                     'errors' => $errors
            ));
        }
        
        $entity->setTypecontrole($request->request->get('anomaliesbundle_typecontrole')['typecontrole']);   
                
//        $em->persist($entity);

        try{     

             $em->flush();

        }catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException  $e){           

             $this->container->get('session')->getFlashBag()->add("error", "L'enregistrement existe déjà dans la base de données!");

             return $this->redirect($this->generateUrl('typecontrole_new'));
        };


        $this->container->get('session')->getFlashBag()->add("notice", "Enregistrement ajouté avec succès!"); 

        return $this->redirect($this->generateUrl('typecontrole'));  
    }
    
    
    /**
     * Deletes a Typecontrole entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AnomaliesBundle:Typecontrole')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Typecontrole entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('typecontrole'));
    }

    /**
     * Creates a form to delete a Typecontrole entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('typecontrole_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
