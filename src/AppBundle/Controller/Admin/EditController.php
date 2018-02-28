<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Post;
use AppBundle\Form\Admin\EditPostForm;
use AppBundle\Entity\Category;
use AppBundle\Form\Admin\EditCategoryForm;

class EditController extends Controller
{
    public function postAction(Request $request, $id)
    {
		$post = $this->getDoctrine()
        ->getRepository(get_class(new Post))->findOneById($id);
		
		/*GENERISANJE FORME ZA POST*/
		$form = $this->createForm(get_class(new EditPostForm), $post);
		
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
				'Post updated successfully!'
			);

			return $this->redirect($request->getUri());
		}		
		
        return $this->render('admin/edit_post.html.twig', array("page" => "admin_post", 
		"form" => $form->createView()));
    }
	
    public function categoryAction(Request $request, $id)
    {
		$category = $this->getDoctrine()
        ->getRepository(get_class(new Category))->findOneById($id);
		
		/*GENERISANJE FORME ZA KATEGORIJE*/
		$form = $this->createForm(get_class(new EditCategoryForm), $category);
		
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
				'Category updated successfully!'
			);

			return $this->redirect($request->getUri());
		}		
		
        return $this->render('admin/edit_category.html.twig', array("page" => "admin_category", 
		"form" => $form->createView()));
    }
}
