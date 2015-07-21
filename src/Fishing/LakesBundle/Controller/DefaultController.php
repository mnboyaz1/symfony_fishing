<?php

namespace Fishing\LakesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FishingLakesBundle:Default:index.html.twig', array('name' => $name));
    }
}
