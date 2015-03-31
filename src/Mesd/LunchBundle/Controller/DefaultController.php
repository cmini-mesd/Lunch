<?php

namespace Mesd\LunchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MesdLunchBundle:Default:index.html.twig', array('name' => $name));
    }
}
