<?php
namespace Fishing\UsersBundle\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class SecurityController extends Controller
{
	/**
	 * @Route("/Login", name="Login")
	 */
	public function loginAction(Request $request){
		$authenticationUtils = $this->get('security.authentication_utils');
	
	// get the login error if there is one
		$error = $authenticationUtils->getLastAuthenticationError();
		
	// last email entered by the user
		$lastUsername = $authenticationUtils->getLastUsername();
	
		return $this->render('security/login.html.twig',
			array(
				'last_username' => $lastUsername,
				'error'      => $error,
			)
		);
	}
	/**
	 * @Route("/Login_check", name="Login_check")
	 */
	 public function loginCheckAction(){
	 
	 }
	// this controller will not be executed,
    // as the route is handled by the Security system
}