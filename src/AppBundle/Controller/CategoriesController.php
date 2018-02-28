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
		$categories = $this->getDoctrine()->getRepository(get_class(new Category))
        ->findAll();
		$categories = array_filter($categories, function($cat){
			return count($cat->getPost()) > 0 ? true : false;
		});
		/*N+1 PROBLEM!!!*/
		
        return $this->render('sidebar_categories.html.twig', array("categories" => $categories));
    }
}
