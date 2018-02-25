<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\User;
use AppBundle\Form\RegisterForm;
use Symfony\Component\Security\Core\Role\Role;

class LoginController extends Controller
{
    public function registerAction(Request $request)
    {
		/*GENERISANJE FORME ZA KOMENTARE*/
		$form = $this->createForm(get_class(new RegisterForm), new User);
		
		/*OBRADA FORME ZA KOMENTARE*/
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
}
