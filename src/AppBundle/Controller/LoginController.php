<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\User;
use AppBundle\Form\RegisterForm;
use AppBundle\Form\LoginForm;
use Symfony\Component\Security\Core\Role\Role;

class LoginController extends Controller
{
    public function registerAction(Request $request)
    {
		/*GENERISANJE FORME ZA REGISTRACIJU*/
		$form = $this->createForm(get_class(new RegisterForm), new User);
		
		/*OBRADA FORME ZA REGISTRACIJU*/
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$user = $form->getData();
			
			/*ENKRIPTOVANJE ŠIFRE*/
			$password = $this->get('security.password_encoder')
            ->encodePassword($user, $user->getPassword());
			$user->setPassword($password);
			
			/*DODELA ADMINA PRVOM KORISNIKU*/
			$em = $this->getDoctrine()->getManager();
			if($em->getRepository(get_class(new User))->getCount() < 1){
				$user->addRole(new Role("ROLE_ADMIN"));
			}
			
			/*UNOS U BAZU*/
			$em->persist($user);
			$em->flush();
			/*ISPIS PORUKE*/
			$this->addFlash(
				'flash_msg',
				'Successfully registered!'
			);

			return $this->redirect($request->getUri());
		}
		
        return $this->render('register.html.twig', array("form" => $form->createView(),
		"page" => "register"));
    }
	
    public function loginAction(Request $request)
    {
		/*GENERISANJE FORME ZA LOGOVANJE*/
		$form = $this->createForm(get_class(new LoginForm), null);
		
		$authenticationUtils = $this->get('security.authentication_utils');
		$error = $authenticationUtils->getLastAuthenticationError();
		
        return $this->render('login.html.twig', array("form" => $form->createView(),
		"page" => "login", "error" => $error));
    }
}
