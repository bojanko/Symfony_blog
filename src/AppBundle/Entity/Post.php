<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Category;
use AppBundle\Entity\Comment;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostRepository")
 */
class Post
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
      * @var \Doctrine\Common\Collections\ArrayCollection|Category[]
      *
      * @ORM\ManyToMany(targetEntity="Category", inversedBy="postovi")
      * @ORM\JoinTable(
      *  name="post_category",
      *  joinColumns={
      *      @ORM\JoinColumn(name="post", referencedColumnName="id")
      *  },
      *  inverseJoinColumns={
      *      @ORM\JoinColumn(name="category", referencedColumnName="id")
      *  }
      * )
      */
    private $kategorije;
	
	/**
     * @var \Doctrine\Common\Collections\ArrayCollection|Category[]
     *
     * @ORM\ManyToMany(targetEntity="Comment")
     * @ORM\JoinTable(name="post_comment",
     *      joinColumns={@ORM\JoinColumn(name="post_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="comment_id", referencedColumnName="id", unique=true)}
     *      )
     */
	private $komentari;
	
    /**
     * @var string
     *
     * @ORM\Column(name="naslov", type="string", length=255)
     */
    private $naslov;

    /**
     * @var string
     *
     * @ORM\Column(name="sadrzaj", type="text")
     */
    private $sadrzaj;


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
     * Set naslov
     *
     * @param string $naslov
     * @return Post
     */
    public function setNaslov($naslov)
    {
        $this->naslov = $naslov;

        return $this;
    }

    /**
     * Get naslov
     *
     * @return string 
     */
    public function getNaslov()
    {
        return $this->naslov;
    }

    /**
     * Set sadrzaj
     *
     * @param string $sadrzaj
     * @return Post
     */
    public function setSadrzaj($sadrzaj)
    {
        $this->sadrzaj = $sadrzaj;

        return $this;
    }

    /**
     * Get sadrzaj
     *
     * @return string 
     */
    public function getSadrzaj()
    {
        return $this->sadrzaj;
    }
	
	 /**
     * @return \Doctrine\Common\Collections\ArrayCollection|Category[]
     */
	public function getCategory()
    {
        return $this->kategorije;
    }
	/**
     * @return \Doctrine\Common\Collections\ArrayCollection|Comment[]
     */
	public function getComment()
    {
        return $this->komentari;
    }
	
	public function addCategory($cat){
		$this->kategorije->add($cat);
	}
	
	public function addComment($cat){
		$this->komentari->add($cat);
	}
	
	public function __construct()
    {
        $this->kategorije = new ArrayCollection();
		$this->komentari = new ArrayCollection();
    }
}
