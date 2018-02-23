<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Page;

class AboutWidgetController extends Controller
{
    public function aboutAction(Request $request)
    {
		$page = $this->getDoctrine()->getRepository(get_class(new Page))
        ->findOneByPage("about");
		
        return $this->render('sidebar_about.html.twig', array("sadrzaj" => $page->getSadrzaj()));
    }
}
