<?php
    /*KOD ZA AUTENTIFIKACIJU KORISNIKA*/
	$user = new User("admin", "password", array("ROLE_ADMIN"));
	$token = new UsernamePasswordToken($user, null, 'dev', $user->getRoles());
	$this->get('security.token_storage')->setToken($token);
	$this->get('session')->set('_security_dev', serialize($token));
	$event = new InteractiveLoginEvent($request, $token);
	$this->get("event_dispatcher")->dispatch("security.interactive_login", $event);
	
	if (!$this->get('security.authorization_checker')->isGranted("ROLE_ADMIN")) { 
		 throw $this->createAccessDeniedException('GET OUT!'); 
	}
?>