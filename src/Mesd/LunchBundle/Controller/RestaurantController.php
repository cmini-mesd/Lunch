<?php

namespace Mesd\LunchBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Mesd\LunchBundle\Entity\Restaurant;
use Mesd\LunchBundle\Form\RestaurantType;
use Mesd\LunchBundle\Form\VoteType;

use Mesd\LunchBundle\Entity\Vote;

/**
 * Restaurant controller.
 *
 */
class RestaurantController extends Controller
{

    /**
     * Lists all Restaurant entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MesdLunchBundle:Restaurant')->findAll();
        
        $editForms = [];
        foreach($entities as $entityKey => $entityValue){
            $editForms[$entityValue->getId()] = $this->createEditForm($entityValue)->createView();
            $deleteForms[$entityValue->getId()] = $this-> createDeleteForm($entityValue->getId())->createView();
        }

        $entity = new Restaurant();
        $newForm   = $this->createCreateForm($entity)->createView();

        $voteForm   = $this->createVoteForm();

        $voteFormView = $voteForm->createView();

        $voteForm->handleRequest($request);
        $data = $voteForm->getData();

        if ($voteForm->isValid()) {
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice','Your votes have been submitted!');
            
        }
       


        if ($voteForm->isValid()) {
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
            'entities' => $entities,
            'newForm'   => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
            'voteForm' => $voteFormView,

        ));


    }


    /**
     * Creates a form to create a Vote entity.
     *
     * @param Vote $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createVoteForm()
    {
        $form = $this->createForm(new VoteType(), NULL, array(
            'action' => $this->generateUrl('restaurant'),
            'method' => 'POST',
        ));

        $form->add('castVote', 'submit', array('label' => 'Cast your vote!'));
        
        return $form;
    }

    /**
     * Creates a new Restaurant entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Restaurant();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('restaurant'));
        }

        return $this->render('MesdLunchBundle:Restaurant:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Restaurant entity.
     *
     * @param Restaurant $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Restaurant $entity)
    {
        $form = $this->createForm(new RestaurantType(), $entity, array(
            'action' => $this->generateUrl('restaurant_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));


        return $form;
    }

    /**
     * Displays a form to create a new Restaurant entity.
     *
     */
    public function newAction()
    {
        $entity = new Restaurant();
        $form   = $this->createCreateForm($entity);

        return $this->render('MesdLunchBundle:Restaurant:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),


        ));
    }

    /**
     * Finds and displays a Restaurant entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MesdLunchBundle:Restaurant')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Restaurant entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MesdLunchBundle:Restaurant:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Restaurant entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MesdLunchBundle:Restaurant')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Restaurant entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MesdLunchBundle:Restaurant:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Restaurant entity.
    *
    * @param Restaurant $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Restaurant $entity)
    {
        $form = $this->createForm(new RestaurantType(), $entity, array(
            'action' => $this->generateUrl('restaurant_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Restaurant entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MesdLunchBundle:Restaurant')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Restaurant entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice','Your changes were saved!');
            return $this->redirect($this->generateUrl('restaurant', array('id' => $id)));

        }

        return $this->render('MesdLunchBundle:Restaurant:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Restaurant entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MesdLunchBundle:Restaurant')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Restaurant entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('restaurant'));
    }

    /**
     * Creates a form to delete a Restaurant entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('restaurant_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('delete', 'delete', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
