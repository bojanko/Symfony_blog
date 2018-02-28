<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Post;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;

    /**
     * @var string
	 *
	 * @ORM\Column(name="name", type="string", length=255)
	 * @Assert\NotBlank(
	 *     message = "Name is required."
	 *)
     */
    private $name;

     /**
      * @var \Doctrine\Common\Collections\ArrayCollection|Post[]
      *
      * @ORM\ManyToMany(targetEntity="Post", mappedBy="kategorije", fetch="EAGER")
      */
	private $postovi;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
	
	/**
     * @return \Doctrine\Common\Collections\ArrayCollection|Post[]
     */
	public function getPost()
    {
        return $this->postovi;
    }
	
	public function addPost($cat){
		$this->postovi->add($cat);
	}
	
	public function __construct()
    {
        $this->postovi = new ArrayCollection();
    }
}
