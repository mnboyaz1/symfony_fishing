<?php

namespace Fishing\UsersBundle\Controller;

use AppBundle\Entity\Users;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ViewUsersController extends Controller
{
	/**
     * @Route("/viewusers", name="viewusers")
	 * 
     */

	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();
		
		$users = $em->getRepository('AppBundle:Users')->findAll();
		
		return $this->render('default/viewUsers.html.twig',
		array('users' => $users,));
	}
	
	
}