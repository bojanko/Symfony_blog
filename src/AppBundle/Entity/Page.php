<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Page
 *
 * @ORM\Table(name="page")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PageRepository")
 */
class Page
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="page", type="string", length=255)
     */
    private $page;

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
     * Set page
     *
     * @param string $page
     * @return Page
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return string 
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set sadrzaj
     *
     * @param string $sadrzaj
     * @return Page
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
}
