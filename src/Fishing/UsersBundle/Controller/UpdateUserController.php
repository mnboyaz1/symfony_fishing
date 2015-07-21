<?php

namespace Fishing\UsersBundle\Controller;

use AppBundle\Entity\UpdateUsers;
use AppBundle\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserController extends Controller
{
	/**
     * @Route("/updateuser", name="updateuser")
	 * 
     */
	
	 
	public function indexAction(Request $request)
	{
	// Form to get Name from user to retrieve record from database
		$users = new UpdateUsers();
		$form =$this->createFormBuilder($users)
			->setMethod('POST')
			->add('firstName', 'text')
			->add('lastName', 'text')
			->add('save', 'submit', array('label' => 'Find User'))
			->getForm();
			
		$form->handleRequest($request);	
		
		if (!$form->isSubmitted()) {
			return $this->render('default/updateuserForm.html.twig', array(
				'form' => $form->createView(),	
			));
		} else if ($form->isSubmitted() && $form->isValid()) {
			// Query users database for record matching clients entry
			
			$em = $this->getDoctrine()->getManager();
			$query = $em->createQuery(
			'SELECT p FROM AppBundle:Users p
			WHERE p.firstName = :firstName 
			AND p.lastName = :lastName'
			)->setParameter('firstName', $users->firstName)
			->setParameter('lastName', $users->lastName);
		
			$users = $query->getResult();
			
			
			
			
			return $this->render('default/viewUsers.html.twig',
			array('users' => $users));
			
			/*
			// auto fill client info for updating
			
			$updateUsers = new Users();
			$updateUsers->setUpdatedat(new \DateTime('now'));
			//$updateUsers->setFirstName($users->firstName);
		
			$form2 =$this->createFormBuilder($updateUsers)
				->setMethod('PUT')
				->add('firstName', 'text') ?? value="{{ last_username }}"  ??
				->add('lastName', 'text')
				->add('email', 'email')
				->add('plainPassword','password')
				->add('save', 'submit', array('label' => 'Update User'))
				->getForm();
			
			$form2->handleRequest($request);
			
			if (!$form2->isSubmitted()) {
			return $this->render('default/userForm2Update.html.twig', array(
				'users' => $users,'form' => $form2->createView(),
			));
			} else {
				return new Response('notsubmitted!!');
			}
			*/
		}else {
		
			dump((string) $form->getErrors(true));
        
			return new Response('notvalid!!');		
		}
	
	
		
	

		
	}	
		
}

?>