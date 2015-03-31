<?php

namespace Mesd\LunchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VotingController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MesdLunchBundle:Restaurant')->findAll();

        // var_dump($entities); //prints whatever is in the array
        // exit;

        return $this->render('MesdLunchBundle:Voting:index.html.twig', array(
            'entities' => $entities));
    }
}
