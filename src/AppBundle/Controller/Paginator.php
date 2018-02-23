<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;

class Paginator{
	protected $em;

	private $size = 5;
	private $page = 1;
	private $pages = 1;
	private $prev = 0;
	private $l1 = 0;
	private $l2 = 0;
	private $l3 = 0;
	private $next = 0;
	private $active = "";
	
	private function pageCount(){
		$count = $this->em->getRepository(get_class(new Post))
        ->getCount();
		$this->pages = ceil($count / $this->size);
	}
	
	private function calculate(){
		if($this->page > 1 && $this->page < $this->pages){
			$this->prev = $this->page - 1;
			$this->l1 = $this->page - 1;
			$this->l2 = $this->page;
			$this->l3 = $this->page + 1;
			$this->next = $this->page + 1;
			$this->active = "l2";
		}
		elseif($this->page > 1 && $this->page == $this->pages){
			$this->prev = $this->page - 1;
			$this->l1 = $this->page - 1;
			$this->l2 = $this->page;
			$this->l3 = 0;
			$this->next = 0;
			$this->active = "l2";
		}
		else{
			$this->prev = 0;
			$this->l1 = 1;
			$this->pages > $this->page ? $this->l2 = 2 : $this->l2 = 0;
			$this->pages > $this->page + 1 ? $this->l3 = 3 : $this->l3 = 0;
			$this->pages > $this->page ? $this->next = 2 : $this->next = 0;
			$this->active = "l1";
		}
	}
	
	public function __construct($entityManager, $s = 5, $p = 1){
		$this->em = $entityManager;
		$this->size = $s;
		$this->page = $p;
		$this->pageCount();
		$this->calculate();
	}
	
	public function getPosts(){
		return $this->em->getRepository(get_class(new Post))
        ->getPaginatedPosts($this->page, $this->size);
	}
	
	public function getPrev(){ return $this->prev; }
	public function getL1(){ return $this->l1; }
	public function getL2(){ return $this->l2; }
	public function getL3(){ return $this->l3; }
	public function getNext(){ return $this->next; }
	public function getActive(){ return $this->active; }
}

?>