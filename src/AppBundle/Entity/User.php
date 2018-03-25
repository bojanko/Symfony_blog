<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @UniqueEntity(
 * fields={"email"},
 * message="Email already used!"
 * )
 */
class User implements UserInterface, \Serializable
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
     * @ORM\Column(name="username", type="string", length=255)
	 *
	 * @Assert\Type(
	 *     "alpha",
	 *     message = "Entered username {{ value }} is invalid."
	 *)
	 * @Assert\NotBlank(
	 *     message = "Username is required."
	 *)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
	 * @Assert\Length(
     *      min = 6,
     *      max = 15,
     *      minMessage = "Your password must be at least {{ limit }} characters long",
     *      maxMessage = "Your password cannot be longer than {{ limit }} characters"
     * )
	 * @Assert\NotBlank(
	 *     message = "Password is required."
	 *)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
	 *
	 * @Assert\Email(
     *     message = "The email {{ value }} is not a valid email.",
     *     checkMX = true
     * )
	 * @Assert\NotBlank(
	 *     message = "Email is required."
	 *)
     */
    private $email;

    /**
     * @var bool
     *
     * @ORM\Column(name="isActive", type="boolean")
     */
    private $isActive;
	
    /**
     * @var Role[]
     *
     * @ORM\Column(name="roles", type="array")
     */
	private $roles;
	
	/**
     * @var int
     *
     * @ORM\Column(name="adminRequest", type="integer")
     */
    private $adminRequest;
    //0 - UNSENT, 1 - SENT, NOT PROCESSED, 2 - SENT, PROCESSED

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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
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
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
	
    public function __construct()
    {
        $this->isActive = true;
		$this->adminRequest = 0;
		$this->roles = array(new Role("ROLE_USER"));
    }

    public function getSalt()
    {
        return null;
    }
	
	public function getAdminRequest()
    {
        return $this->adminRequest;
    }
	
	public function setAdminRequest($ar)
    {
        return $this->adminRequest = $ar;
    }

    public function getRoles()
    {
        return $this->roles;
    }
	
	public function addRole($r)
    {
        array_push($this->roles, $r);
		return 1;
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
        ) = unserialize($serialized);
    }

}
