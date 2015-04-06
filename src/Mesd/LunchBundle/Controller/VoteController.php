<?php

namespace Mesd\LunchBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Mesd\LunchBundle\Entity\Vote;
use Mesd\LunchBundle\Form\VoteType;

/**
 * Vote controller.
 *
 */
class VoteController extends Controller
{

    /**
     * Lists all Vote entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MesdLunchBundle:Vote')->findAll();

        return $this->render('MesdLunchBundle:Vote:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Vote entity.
     *
     */
    public function createAction(Request $request)
    {

        $form = $this->createCreateForm();
        $form->handleRequest($request);
        $data = $form->getData();


       


        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
           
            foreach ($data['restaurant'] as $restaurant) {
                $vote = new Vote();
                $voterId =  $request->getClientIp();
                $vote -> setVoterId($voterId);
                $date = new \DateTime();
                $vote -> setVoteDate($date);
                $em->persist($vote);
                $total = $restaurant->getVoteTotal();
                $total++;
                $restaurant -> setVoteTotal($total);  

            }
           
            
            $em->flush();
           

            return $this->redirect($this->generateUrl('restaurant'));
        }

        return $this->render('MesdLunchBundle:Restaurant:index.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Vote entity.
     *
     * @param Vote $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm()
    {
        $form = $this->createForm(new VoteType(), NULL, array(
            'action' => $this->generateUrl('vote_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Vote entity.
     *
     */
    public function newAction()
    {
        $entity = new Vote();
        $form   = $this->createCreateForm($entity);

        return $this->render('MesdLunchBundle:Vote:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Vote entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MesdLunchBundle:Vote')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vote entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MesdLunchBundle:Vote:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Vote entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MesdLunchBundle:Vote')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vote entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MesdLunchBundle:Vote:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Vote entity.
    *
    * @param Vote $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Vote $entity)
    {
        $form = $this->createForm(new VoteType(), $entity, array(
            'action' => $this->generateUrl('vote_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Vote entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MesdLunchBundle:Vote')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vote entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('vote_edit', array('id' => $id)));
        }

        return $this->render('MesdLunchBundle:Vote:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Vote entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MesdLunchBundle:Vote')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Vote entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('vote'));
    }

    /**
     * Creates a form to delete a Vote entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vote_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
