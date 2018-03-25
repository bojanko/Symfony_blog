<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Post;
use AppBundle\Entity\Category;

class DeleteController extends Controller
{
	private function removePost($post){
		$em = $this->getDoctrine()->getManager();
		$comments = $post->getComment();
		/*BRISANJE POSTA*/
		$em->remove($post);
		/*BRISANJE KOMENTARA*/
		foreach($comments as $comment){
			$em->remove($comment);
		}
	}
	
    public function postAction(Request $request, $id)
    {
		$this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');
		
		$em = $this->getDoctrine()->getManager();
		$post = $em->getRepository(get_class(new Post))->findOneById($id);
		
		$this->removePost($post);
        /*CUVANJE PROMENA*/
		$em->flush();
		
		return $this->redirect($this->generateUrl('admin'));
    }
	
    public function categoryAction(Request $request, $id)
    {
		$this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');
		
		$em = $this->getDoctrine()->getManager();
		$category = $em->getRepository(get_class(new Category))->findOneById($id);
		$posts = $category->getPost();
		/*BRISANJE KATEGORIJE*/
		$em->remove($category);
		/*BRISANJE POSTOVA*/
		foreach($posts as $post){
			$this->removePost($post);
		}
		/*CUVANJE PROMENA*/
		$em->flush();
        
		return $this->redirect($this->generateUrl('admin_categories'));
    }
}
