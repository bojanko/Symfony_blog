<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Post;

class LatestPostsController extends Controller
{
    public function postsAction(Request $request)
    {
		$posts = $this->getDoctrine()->getRepository(get_class(new Post))
        ->getLatestPosts();
		
        return $this->render('sidebar_latest.html.twig', array("posts" => $posts));
    }
}
