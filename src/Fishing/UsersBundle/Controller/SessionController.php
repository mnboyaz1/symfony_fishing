<?php
//src\Fishing\UsersBundle\Controller\SessionController.php
namespace Fishing\UsersBundle\Controller;

use AppBundle\EventListener\TokenListener;
use AppBundle\Controller\TokenAuthenticatedController;
use AppBundle\Entity\Users;
use AppBundle\Entity\UpdateUsers;
use AppBundle\Entity\NewSession;
use Fishing\UsersBundle\Controller\UpdateUserController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SessionController extends Controller implements TokenAuthenticatedController
{
	public function indexAction(Request $request) {
	
	// code to get a session
	/////////////////////////
			
		//create session in symfony, bridged to PHP session
		$session = new Session(new PhpBridgeSessionStorage());
		//$session->start();
		if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
		
		
		$session->set('id',0 );
		$currentId = session_id();
		$sessionUserId = $session->get('id');
		
		$session->set('email', 'mnboyaz@msn.com');
		$session->set('password', 'minnesota1');
		//$session->set('id', null);
		$email = $session->get('email');
		$password = $session->get('password');		
		$user = $this->container->get('security.context')->getToken()->getUser();
		$session = $this->getRequest()->getSession();
		
		if (is_int($sessionUserId) && $sessionUserId) {
			// There is a valid user id here 
			echo "Valid user id ".$sessionUserId."<br>";
			echo "Current Session Id ".$currentId."<br>";
		
		// If/else to check session valid
			if ($this->container->get('session')->isStarted()){
				//set flash message
				$session->getFlashBag()->add('notice', 'Profile updated');
			
	
				// retrieve message
				foreach ($session->getFlashBag()->get('notice', array()) as $message){
					echo '<div class="flash-notice">'.$message.' '.$email.' '.$password.'<br>'
					.' session user id  '.$session->get('id').'!'.'cookie life '.$session->getMetadataBag()->getLifetime().
					'User  '.$user.'</div>';
				}	
			}	
		
		}else {
			// User id is not specified or 0
			echo "Invalid user id ".$sessionUserId."<br>";
			echo "Current Session Id ".$currentId."<br>";

			// Form to get email and password from user to retrieve record from database
			$users = new NewSession();
			$form =$this->createFormBuilder($users)
				->setMethod('POST')
				->add('email', 'email')
				->add('plainPassword', 'password')
				->add('save', 'submit', array('label' => 'Find User'))
				->getForm();
			
			$form->handleRequest($request);
		
			if (!$form->isSubmitted()) {
				return $this->render('default/updateuserForm.html.twig', array(
					'form' => $form->createView(),	
			));
			}else if ($form->isSubmitted() && $form->isValid()) {
			// Query users database for record matching clients entry
			
				$em = $this->getDoctrine()->getManager();
				$query = $em->createQuery(
				'SELECT p FROM AppBundle:Users p
				WHERE p.email = :email 
				AND p.plainPassword = :password')
				->setParameter('email', $users->email)
				->setParameter('password', $users->plainPassword);
		
				$users = $query->getResult();
				
				return $this->render('default/viewUsers.html.twig',
					array('users' => $users));
			} else {
				
				return new response('not valid!!');
			}
		}
		//echo "<pre>".print_r($_SESSION,1)."</pre>";
		
		//exit();
		/*
		// set and get session attributes
		$session->set('email', 'mnboyaz@msn.com');
		$session->set('password', 'minnesota1');
		//$session->set('id', null);
		$email = $session->get('email');
		$password = $session->get('password');
		$user = $this->container->get('security.context')->getToken()->getUser();
		$session = $this->getRequest()->getSession();
		
		// If/else to check session valid
		if ($this->container->get('session')->isStarted()){
			//set flash message
			$session->getFlashBag()->add('notice', 'Profile updated');
			
	
			// retrieve message
			foreach ($session->getFlashBag()->get('notice', array()) as $message){
				echo '<div class="flash-notice">'.$message.' '.$email.' '.$password.'<br>'
				.' session user id  '.$session->get('id').'!'.'cookie life '.$session->getMetadataBag()->getLifetime().
				'User  '.$user.'</div>';
			}
		//return $this->redirectToRoute('updateuser');	
			
			
			// query to retreive user data
			$em = $this->getDoctrine()->getManager();
			$query = $em->createQuery(
			'SELECT p FROM AppBundle:Users p
			WHERE p.email = :email
			AND p.plainPassword = :password'
			)->setParameter('email', $email)
			->setParameter('password', $password);
		
			$users = $query->getResult();
			
			
			return $this->render('default/viewUsers.html.twig',
			array('users' => $users));
		return new Response('Great !');
		} else {
			return new Response('Oooops need to redirect to login !');
		}
		
		

		//return new Response('session set for ' .$email.' id num '.$session->getId().'!'.
		//'cookie life '.$session->getMetadataBag()->getLifetime());
		*/
	}

}