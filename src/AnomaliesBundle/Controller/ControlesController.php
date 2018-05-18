<?php

namespace AnomaliesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AnomaliesBundle\Entity\Controles;
use AnomaliesBundle\Form\ControlesType;

/**
 * Controles controller.
 *
 */
class ControlesController extends Controller
{

    /**
     * Lists all Controles entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AnomaliesBundle:Controles')->findBy(array('enabled'=>1));

        return $this->render('AnomaliesBundle:Controles:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    
    /**
     * Creates a new Controles entity.
     *
     */
    public function createAction(Request $request)
    {      
        $entity = new Controles();
          
        $form = $this->createForm(new ControlesType($this->container), $entity);
 
        $form->handleRequest($request);
        $validator = $this->get('validator');
        $errors = $validator->validate($form);    
    
        if (count($errors) > 0) 
        {          

            return $this->render('AnomaliesBundle:Controles:new.html.twig', array(
                'entity' => $entity,
                'form' => $form->createView()
            ));
    
//            return $this->render('AnomaliesBundle:Controles:new.html.php', array(
//                'entity' => $entity,
//                'form' => $form->createView()
//            ));
        }

        $em = $this->getDoctrine()->getManager();
        
        $entity->setControle($request->request->get('anomaliesbundle_controles')['controle']);  
        $entity->setEchantillon($request->request->get('anomaliesbundle_controles')['echantillon']);      
        $entity->setPeriodetravaux($request->request->get('anomaliesbundle_controles')['periodetravaux']);
        
        //momentan datele sunt serializate dar nefolosite la afisare
        //$entity->setTypesociete(serialize($request->request->get('anomaliesbundle_controles')['typesociete']));        
        //$entity->setTypetache(serialize($request->request->get('anomaliesbundle_controles')['typetache']));  
        //$entity->setTypecontrole(serialize($request->request->get('anomaliesbundle_controles')['typecontrole']));  
        
        $entity->setEnabled(1);
        $em->persist($entity);

        try
        {             
           $em->flush();                                        
        }
        catch( Doctrine\ORM\ORMException $e)
        {                  
           return $this->redirect($this->generateUrl('controles'));
        };
              
        $this->container->get('session')->getFlashBag()->add("notice", "Enregistrement ajouté avec succès!"); 
        
        return $this->redirect($this->generateUrl('controles')); 
    }



    /**
     * Displays a form to create a new Controles entity.
     *
     */
    public function newAction()
    {        
        $entity = new Controles();

        $form = $this->createForm(new ControlesType($this->container), $entity);
        
        return $this->render('AnomaliesBundle:Controles:new.html.twig', array(
                             'entity' => $entity,
                             'form'   => $form->createView(),
                            ));
  
    }

    /**
     * Finds and displays a Controles entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AnomaliesBundle:Controles')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Controles entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AnomaliesBundle:Controles:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Controles entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AnomaliesBundle:Controles')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Controles entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AnomaliesBundle:Controles:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Controles entity.
    *
    * @param Controles $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Controles $entity)
    {
        $form = $this->createForm(new ControlesType(), $entity, array(
            'action' => $this->generateUrl('controles_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Controles entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AnomaliesBundle:Controles')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Controles entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('controles_edit', array('id' => $id)));
        }

        return $this->render('AnomaliesBundle:Controles:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Controles entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AnomaliesBundle:Controles')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Controles entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('controles'));
    }

    /**
     * Creates a form to delete a Controles entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('controles_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
