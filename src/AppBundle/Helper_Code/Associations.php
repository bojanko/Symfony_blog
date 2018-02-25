<?php
/*KOD ZA UNOS POVEZANIH OBJEKATA U BAZU*/
	$k1 = new Category;
	$k1->setName("Kategorija1");
	$k2 = new Category;
	$k2->setName("Kategorija2");
	$k3 = new Category;
	$k3->setName("Kategorija3");
	
	$em = $this->getDoctrine()->getManager();

	for($i=0; $i < 1000; $i++){
		$pom1 = new Post;
		$pom1->setNaslov("Post".$i);
		$pom1->setSadrzaj("Example post ".$i);
		switch($i % 3){
			case 0:{
				$pom1->addCategory($k3);
				$k3->addPost($pom1);
				break;
			}
			case 1:{
				$pom1->addCategory($k1);
				$k1->addPost($pom1);
				break;
			}
			case 2:{
				$pom1->addCategory($k2);
				$k2->addPost($pom1);
				$pom1->addCategory($k3);
				$k3->addPost($pom1);
			}
		}
		
		$em->persist($pom1);
	}

	$em->persist($k1);
	$em->persist($k2);
	$em->persist($k3);
	$em->flush();
?>