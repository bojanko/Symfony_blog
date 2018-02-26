<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\User;
use AppBundle\Entity\ChangePassword;
use AppBundle\Form\PasswordForm;
use Symfony\Component\Security\Core\Role\Role;

class ProfileController extends Controller
{
    public function profileAction(Request $request)
    {
		/*GENERISANJE FORME ZA PROMENU ŠIFRE*/
		$form = $this->createForm(get_class(new PasswordForm), new ChangePassword);
		
		/*OBRADA FORME ZA REGISTRACIJU*/
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$pass = $form->getData();
			$user = $this->getUser();
			
			/*ENKRIPTOVANJE ŠIFRE*/
			$password = $this->get('security.password_encoder')
            ->encodePassword($user, $pass->getPassword());
			$user->setPassword($password);
			
			/*UNOS U BAZU*/
			$em = $this->getDoctrine()->getManager();
			$em->persist($user);
			$em->flush();
			/*ISPIS PORUKE*/
			$this->addFlash(
				'flash_msg',
				'Successfully updated password!'
			);

			return $this->redirect($request->getUri());
		}
		
        return $this->render('profile.html.twig', array("form" => $form->createView(),
		"page" => "register"));
    }
}
