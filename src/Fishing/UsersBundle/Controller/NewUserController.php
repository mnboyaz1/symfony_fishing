<?php

namespace Fishing\UsersBundle\Controller;

use AppBundle\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class NewUserController extends Controller
{

	/**
     * @Route("/newuser", name="newuser")
     */
	public function indexAction(Request $request)
	{
		$users = new Users();
		$users->setCreatedat(new \DateTime('now'));
		$users->setUpdatedat(new \DateTime('now'));
		
		$form =$this->createFormBuilder($users)
			->setMethod('POST')
			->add('firstName', 'text')
			->add('lastName', 'text')
			->add('email', 'email')
			->add('plainPassword','password')
			->add('save', 'submit', array('label' => 'Create User'))
			->getForm();
			
		$form->handleRequest($request);	
		
		
		if (!$form->isSubmitted()) {
			return $this->render('default/userForm.html.twig', array(
				'form' => $form->createView(),
			));	
		}
		else if ($form->isSubmitted() && $form->isValid()) {
        // perform some action...
			$em = $this->getDoctrine()->getManager();

			$em->persist($users);
			$em->flush();
			
		return new Response('isValid!');
		} 
		else {
		
		dump((string) $form->getErrors(true));
        
		return new Response('notvalid');		
		}
		
	}
}