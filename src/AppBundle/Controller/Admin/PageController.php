<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\User;
use AppBundle\Entity\Comment;

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
		$comments = $this->getDoctrine()
        ->getRepository(get_class(new Comment))->findByOdobren(0);
		
        return $this->render('admin/comments.html.twig', array("page" => "comments",
		"comments" => $comments));
    }
	
	public function categoriesAction(Request $request)
    {
        return $this->render('admin/page.html.twig', array("page" => "categories"));
    }
}
