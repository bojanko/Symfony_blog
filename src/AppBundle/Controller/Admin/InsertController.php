<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Post;
use AppBundle\Form\Admin\PostForm;

class InsertController extends Controller
{
    public function postAction(Request $request)
    {
		/*GENERISANJE FORME ZA POST*/
		$form = $this->createForm(get_class(new PostForm), new Post);
		
		/*OBRADA FORME ZA KOMENTARE*/
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$post = $form->getData();
			/*UNOS U BAZU*/
			$em = $this->getDoctrine()->getManager();
			$em->persist($post);
			$em->flush();
			/*ISPIS PORUKE*/
			$this->addFlash(
				'flash_msg',
				'Post inserted successfully!'
			);

			return $this->redirect($request->getUri());
		}		
		
        return $this->render('admin/add_post.html.twig', array("page" => "admin_post", 
		"form" => $form->createView()));
    }
	
    public function categoryAction(Request $request)
    {
        return $this->render('admin/page.html.twig', array("page" => "new_category"));
    }
}
