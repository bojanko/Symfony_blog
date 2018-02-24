<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Page;
use AppBundle\Entity\Post;
use AppBundle\Controller\Paginator;
use AppBundle\Entity\Contact;
use AppBundle\Form\ContactForm;
use AppBundle\Entity\Category;

class PageController extends Controller
{
    public function homeAction(Request $request, $page = 1)
    {
		$p = $this->container->get('paginator');
		$p->paginate(5, $page);
		
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
	
	public function postAction(Request $request, $id)
    {
		$post = $this->getDoctrine()
        ->getRepository(get_class(new Post))
        ->findOneById($id);
		
        return $this->render('post.html.twig', array("page" => "post", "post" => $post));
    }
	
	public function categoryAction(Request $request, $id, $page=1)
    {
		$category = $this->getDoctrine()
        ->getRepository(get_class(new Category))
        ->findOneById($id);
		
		$num_pp = 5;
		$posts = $category->getPost()->toArray();
		
		/*SORTIRANJE OD NAJNOVIJEG KA NAJSTARIJEM*/
		$comparator = function($a, $b){
			if ($a->getId() == $b->getId()) {
				return 0;
			}
			return ($a->getId() < $b->getId()) ? 1 : -1;
		};
		usort($posts, $comparator);
		
		$p = $this->container->get('paginator');
		$p->paginate($num_pp, $page, count($posts));
		
		return $this->render('category.html.twig', array("page" => "categories", "catid" => $id,
		"posts" => array_slice($posts, ($page - 1) * $num_pp, $num_pp),
		"prev" => $p->getPrev(), "l1" => $p->getL1(), "l2" => $p->getL2(),
		"l3" => $p->getL3(), "next" => $p->getNext(), "active" => $p -> getActive()));
    }
	
	public function contactAction(Request $request)
    {
		$page = $this->getDoctrine()
        ->getRepository(get_class(new Page))
        ->findOneByPage("contact");
		
		/*GENERISANJE KONTAKT FORME*/
		$form = $this->createForm(get_class(new ContactForm), new Contact);
		
		/*OBRADA KONTAKT FORME*/
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$contact = $form->getData();
			/*SLANJE EMAIL-A*/
			$message = (new \Swift_Message(
			strlen($contact->getIme()) > 0 ? 'Contact from '.$contact->getIme()
			: 'Contact from blog'))
			->setFrom($contact->getEmail())
			->setTo('hi@symfony.app')
			->setBody($contact->getPoruka());
			$this->get('mailer')->send($message);
			
			return $this->redirect($request->getUri());
		}
		
        return $this->render('contact.html.twig', array("page" => "contact",
		"txt" => $page->getSadrzaj(), "form" => $form->createView()));
    }
}
