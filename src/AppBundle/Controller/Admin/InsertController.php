<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Post;
use AppBundle\Form\Admin\PostForm;
use AppBundle\Entity\Category;
use AppBundle\Form\Admin\CategoryForm;

class InsertController extends Controller
{
    public function postAction(Request $request)
    {
		$this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');
		
		/*GENERISANJE FORME ZA POST*/
		$form = $this->createForm(get_class(new PostForm), new Post);
		
		/*OBRADA FORME ZA POST*/
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
		$this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');
		
		/*GENERISANJE FORME ZA KATEGORIJE*/
		$form = $this->createForm(get_class(new CategoryForm), new Category);
		
		/*OBRADA FORME ZA KATEGORIJE*/
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$category = $form->getData();
			/*UNOS U BAZU*/
			$em = $this->getDoctrine()->getManager();
			$em->persist($category);
			$em->flush();
			/*ISPIS PORUKE*/
			$this->addFlash(
				'flash_msg',
				'Category created successfully!'
			);

			return $this->redirect($request->getUri());
		}		
		
        return $this->render('admin/add_category.html.twig', array("page" => "admin_category", 
		"form" => $form->createView()));
    }
}
