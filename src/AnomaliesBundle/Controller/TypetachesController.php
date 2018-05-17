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
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('typetaches_show', array('id' => $entity->getId())));
        }

        return $this->render('AnomaliesBundle:Typetaches:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
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
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AnomaliesBundle:Typetaches')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Typetaches entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AnomaliesBundle:Typetaches:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Typetaches entity.
    *
    * @param Typetaches $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Typetaches $entity)
    {
        $form = $this->createForm(new TypetachesType(), $entity, array(
            'action' => $this->generateUrl('typetaches_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
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

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('typetaches_edit', array('id' => $id)));
        }

        return $this->render('AnomaliesBundle:Typetaches:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Typetaches entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AnomaliesBundle:Typetaches')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Typetaches entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('typetaches'));
    }

    /**
     * Creates a form to delete a Typetaches entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('typetaches_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}