<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Core\Role\Role;
use AppBundle\Entity\User;

class GrantController extends Controller
{
    public function adminAction(Request $request, $id, $allow)
    {
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
}
