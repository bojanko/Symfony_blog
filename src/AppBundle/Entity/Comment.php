<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ime", type="string", length=255)
     *
	 * @Assert\Type(
	 *     "alpha",
	 *     message = "Entered name {{ value }} is invalid."
	 *)
	 * @Assert\NotBlank(
	 *     message = "Name is required."
	 *)
     */
    protected $ime;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
	 *
	 * @Assert\Email(
     *     message = "The email {{ value }} is not a valid email.",
     *     checkMX = true
     * )
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="komentar", type="text")
	 *
	 * @Assert\NotBlank(
	 *     message = "Comment cannot be empty."
	 *)
     */
    private $komentar;

    /**
     * @var int
     *
     * @ORM\Column(name="odobren", type="integer")
     */
    protected $odobren;


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
     * Set ime
     *
     * @param string $ime
     * @return Comment
     */
    public function setIme($ime)
    {
        $this->ime = $ime;

        return $this;
    }

    /**
     * Get ime
     *
     * @return string 
     */
    public function getIme()
    {
        return $this->ime;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Comment
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set komentar
     *
     * @param string $komentar
     * @return Comment
     */
    public function setKomentar($komentar)
    {
        $this->komentar = $komentar;

        return $this;
    }

    /**
     * Get komentar
     *
     * @return string 
     */
    public function getKomentar()
    {
        return $this->komentar;
    }

    /**
     * Set odobren
     *
     * @param integer $odobren
     * @return Comment
     */
    public function setOdobren($odobren)
    {
        $this->odobren = $odobren;

        return $this;
    }

    /**
     * Get odobren
     *
     * @return integer 
     */
    public function getOdobren()
    {
        return $this->odobren;
    }
}
