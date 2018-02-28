<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Post;

class DeleteController extends Controller
{
    public function postAction(Request $request, $id)
    {
		$em = $this->getDoctrine()->getManager();
		$post = $em->getRepository(get_class(new Post))->findOneById($id);
		$comments = $post->getComment();
		/*BRISANJE POSTA*/
		$em->remove($post);
		/*BRISANJE KOMENTARA*/
		foreach($comments as $comment){
			$em->remove($comment);
		}
		/*CUVANJE PROMENA*/
		$em->flush();
        
		return $this->redirect($this->generateUrl('admin'));
    }
	
    public function categoryAction(Request $request, $id)
    {
        return $this->redirect($request->getUri());
    }
}
