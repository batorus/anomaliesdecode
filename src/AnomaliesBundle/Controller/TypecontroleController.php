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

        $entities = $em->getRepository('AnomaliesBundle:Typecontrole')->findAll();

        return $this->render('AnomaliesBundle:Typecontrole:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Typecontrole entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Typecontrole();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('typecontrole_show', array('id' => $entity->getId())));
        }

        return $this->render('AnomaliesBundle:Typecontrole:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Typecontrole entity.
     *
     * @param Typecontrole $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Typecontrole $entity)
    {
        $form = $this->createForm(new TypecontroleType(), $entity, array(
            'action' => $this->generateUrl('typecontrole_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Typecontrole entity.
     *
     */
    public function newAction()
    {
        $entity = new Typecontrole();
        $form   = $this->createCreateForm($entity);

        return $this->render('AnomaliesBundle:Typecontrole:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Typecontrole entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AnomaliesBundle:Typecontrole')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Typecontrole entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AnomaliesBundle:Typecontrole:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Typecontrole entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AnomaliesBundle:Typecontrole')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Typecontrole entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AnomaliesBundle:Typecontrole:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Typecontrole entity.
    *
    * @param Typecontrole $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Typecontrole $entity)
    {
        $form = $this->createForm(new TypecontroleType(), $entity, array(
            'action' => $this->generateUrl('typecontrole_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
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

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('typecontrole_edit', array('id' => $id)));
        }

        return $this->render('AnomaliesBundle:Typecontrole:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
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
