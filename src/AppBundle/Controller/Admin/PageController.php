<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\User;
use AppBundle\Entity\Comment;
use AppBundle\Entity\Category;

class PageController extends Controller
{
    public function adminAction(Request $request, $page = 1)
    {
		$p = $this->container->get('paginator');
		$p->paginate(5, $page);

        return $this->render('admin/post_list.html.twig', array("page" => "posts", "posts" => $p->getPosts(),
		"prev" => $p->getPrev(), "l1" => $p->getL1(), "l2" => $p->getL2(),
		"l3" => $p->getL3(), "next" => $p->getNext(), "active" => $p -> getActive()));
    }
	
	public function requestsAction(Request $request)
    {
		$requests = $this->getDoctrine()
        ->getRepository(get_class(new User))->findByAdminRequest(1);
		
        return $this->render('admin/admin_request.html.twig', array("page" => "adminrequests",
		"requests" => $requests));
    }
	
	public function commentsAction(Request $request)
    {
		$comments = $this->getDoctrine()
        ->getRepository(get_class(new Comment))->findByOdobren(0);
		
        return $this->render('admin/comments.html.twig', array("page" => "comments",
		"comments" => $comments));
    }
	
	public function categoriesAction(Request $request, $page = 1)
    {
		$num_pp = 5;
		$categories = $this->getDoctrine()
        ->getRepository(get_class(new Category))->findAll();
		
		$p = $this->container->get('paginator');
		$p->paginate(5, $page, count($categories));

        return $this->render('admin/category_list.html.twig', array("page" => "categories",
		"categories" => array_slice($categories, ($page - 1) * $num_pp, $num_pp),
		"prev" => $p->getPrev(), "l1" => $p->getL1(), "l2" => $p->getL2(),
		"l3" => $p->getL3(), "next" => $p->getNext(), "active" => $p -> getActive()));
    }
}
