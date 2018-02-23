<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Page;
use AppBundle\Entity\Post;

class PageController extends Controller
{
    public function homeAction(Request $request, $page = 1)
    {
		$posts = $this->getDoctrine()
        ->getRepository(get_class(new Post))
        ->getPaginatedPosts($page);
		
		/*Podaci za paginaciju*/
		$count = $this->getDoctrine()
        ->getRepository(get_class(new Post))
        ->getCount();
		$pages = ceil($count / 5);
		
		if($page > 1 && $page < $pages){
			$prev = $page - 1;
			$l1 = $page - 1;
			$l2 = $page;
			$l3 = $page + 1;
			$next = $page + 1;
			$active = "l2";
		}
		elseif($page > 1 && $page == $pages){
			$prev = $page - 1;
			$l1 = $page - 1;
			$l2 = $page;
			$l3 = 0;
			$next = 0;
			$active = "l2";
		}
		else{
			$prev = 0;
			$l1 = 1;
			$count > $page * 5 ? $l2 = 2 : $l2 = 0;
			$count > ($page + 1) * 5 ? $l3 = 3 : $l3 = 0;
			$count > $page * 5 ? $next = 2 : $next = 0;
			$active = "l1";
		}
		
        return $this->render('home.html.twig', array("page" => "home", "posts" => $posts,
		"prev" => $prev, "l1" => $l1, "l2" => $l2, "l3" => $l3, "next" => $next, "active" => $active));
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
