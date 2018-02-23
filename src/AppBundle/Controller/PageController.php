<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Page;
use AppBundle\Entity\Post;
use AppBundle\Controller\Paginator;

class PageController extends Controller
{
    public function homeAction(Request $request, $page = 1)
    {
		$p = new Paginator($this->getDoctrine()->getManager(), 5, $page);
		
        return $this->render('home.html.twig', array("page" => "home", "posts" => $p->getPosts(),
		"prev" => $p->getPrev(), "l1" => $p->getL1(), "l2" => $p->getL2(),
		"l3" => $p->getL3(), "next" => $p->getNext(), "active" => $p -> getActive()));
    }
	
	public function aboutAction(Request $request)
    {
		$page = $this->getDoctrine()
        ->getRepository(get_class(new Page))
        ->findOneByPage("about");
		
        return $this->render('about.html.twig', array("page" => "about", "txt" => $page->getSadrzaj()));
    }
	
	public function contactAction(Request $request)
    {
		$page = $this->getDoctrine()
        ->getRepository(get_class(new Page))
        ->findOneByPage("contact");
		
		/*$message = (new \Swift_Message('Hello Email'))
        ->setFrom('send@example.com')
        ->setTo('recipient@example.com')
        ->setBody("test");

		$this->get('mailer')->send($message);*/
		
        return $this->render('contact.html.twig', array("page" => "contact", "txt" => $page->getSadrzaj()));
    }
}
