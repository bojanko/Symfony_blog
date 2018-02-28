<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Core\Role\Role;
use AppBundle\Entity\User;
use AppBundle\Entity\Comment;

class GrantController extends Controller
{
    public function adminAction(Request $request, $id, $allow)
    {
		$this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');
		
		$user = $this->getDoctrine()
        ->getRepository(get_class(new User))->findOneById($id);
		
		if($allow === "true"){
			$role = new Role("ROLE_ADMIN");
			$user->addRole($role);
		}
		$user->setAdminRequest(2);
		$em = $this->getDoctrine()->getManager();
		$em->flush();
		
        return $this->redirect($this->generateUrl('admin_requests'));
    }
	
    public function commentAction(Request $request, $id, $allow)
    {
		$this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');
		
		$comment = $this->getDoctrine()
        ->getRepository(get_class(new Comment))->findOneById($id);
		
		$em = $this->getDoctrine()->getManager();
		if($allow === "true"){
			$comment->setOdobren(1);
		}
		else{
			$comment->setOdobren(2);
		}
		$em->flush();
		
        return $this->redirect($this->generateUrl('comments'));
    }
}
