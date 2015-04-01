<?php

namespace Mesd\LunchBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Mesd\LunchBundle\Entity\Style;
use Mesd\LunchBundle\Form\StyleType;

/**
 * Style controller.
 *
 */
class StyleController extends Controller
{

    /**
     * Lists all Style entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MesdLunchBundle:Style')->findAll();

        return $this->render('MesdLunchBundle:Style:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Style entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Style();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('style_show', array('id' => $entity->getId())));
        }

        return $this->render('MesdLunchBundle:Style:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Style entity.
     *
     * @param Style $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Style $entity)
    {
        $form = $this->createForm(new StyleType(), $entity, array(
            'action' => $this->generateUrl('style_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Style entity.
     *
     */
    public function newAction()
    {
        $entity = new Style();
        $form   = $this->createCreateForm($entity);

        return $this->render('MesdLunchBundle:Style:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Style entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MesdLunchBundle:Style')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Style entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MesdLunchBundle:Style:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Style entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MesdLunchBundle:Style')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Style entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MesdLunchBundle:Style:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Style entity.
    *
    * @param Style $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Style $entity)
    {
        $form = $this->createForm(new StyleType(), $entity, array(
            'action' => $this->generateUrl('style_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Style entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MesdLunchBundle:Style')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Style entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('style_edit', array('id' => $id)));
        }

        return $this->render('MesdLunchBundle:Style:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Style entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MesdLunchBundle:Style')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Style entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('style'));
    }

    /**
     * Creates a form to delete a Style entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('style_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
