<?php

namespace Mesd\LunchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

use Mesd\LunchBundle\Entity\Restaurant;
use Mesd\LunchBundle\Form\RestaurantType;
use Mesd\LunchBundle\Form\VoteType;

use Mesd\LunchBundle\Entity\Vote;

class ChosenController extends Controller
{
    public function indexAction(Request $request)
    {	
    	$em = $this->getDoctrine()->getManager();
    	$restaurant = $em->getRepository('MesdLunchBundle:Restaurant')->findRestaurant();


        return $this->render('MesdLunchBundle:Chosen:index.html.twig', array(
        	'restaurant' => $restaurant 
      ));
    }
}


// make this return the results of the builder that should give you the the randomized restaurant