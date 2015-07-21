<?php

namespace Fishing\UsersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FishingUsersBundle:Default:index.html.twig', array('name' => $name));
    }
	
	/**
	 *@Route("/admin")
	 */
	 public function adminAction()
	 {
		return new Response('Admin page!');
	 }
}
