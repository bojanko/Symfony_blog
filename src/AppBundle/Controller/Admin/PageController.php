<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\User;

class PageController extends Controller
{
    public function adminAction(Request $request)
    {
        return $this->render('admin/page.html.twig', array("page" => "posts"));
    }
	
	public function requestsAction(Request $request)
    {
		$requests = $this->getDoctrine()
        ->getRepository(get_class(new User))->findByAdminRequest(1);
		
        return $this->render('admin/admin_request.html.twig', array("page" => "adminrequests",
		"requests" => $requests));
    }
	
	public function commentsAction(Request $request)
    {
        return $this->render('admin/page.html.twig', array("page" => "comments"));
    }
	
	public function categoriesAction(Request $request)
    {
        return $this->render('admin/page.html.twig', array("page" => "categories"));
    }
}
