<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{
    public function adminAction(Request $request)
    {
        return $this->render('admin/page.html.twig', array("page" => "posts"));
    }
	
	public function requestsAction(Request $request)
    {
        return $this->render('admin/page.html.twig', array("page" => "adminrequests"));
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
