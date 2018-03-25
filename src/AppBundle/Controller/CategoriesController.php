<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Category;

class CategoriesController extends Controller
{
    public function categoriesAction(Request $request)
    {
		/*$categories = $this->getDoctrine()->getRepository(get_class(new Category))
        ->findAll();
		$categories = array_filter($categories, function($cat){
			return count($cat->getPost()) > 0 ? true : false;
		});*/
		/*N+1 PROBLEM!!!*/
		$em = $this->getDoctrine()->getManager();
		$query = $em->createQuery('SELECT c FROM AppBundle\Entity\Category c WHERE SIZE(c.postovi) > 0');
		$categories = $query->getResult();
	
        return $this->render('sidebar_categories.html.twig', array("categories" => $categories));
    }
}
