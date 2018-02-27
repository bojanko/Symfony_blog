<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class InsertController extends Controller
{
    public function postAction(Request $request)
    {
        return $this->render('admin/page.html.twig', array("page" => "new_posts"));
    }
	
    public function categoryAction(Request $request)
    {
        return $this->render('admin/page.html.twig', array("page" => "new_category"));
    }
}
