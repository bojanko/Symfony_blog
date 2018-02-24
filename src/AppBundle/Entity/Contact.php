<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @Assert\Type(
	 *     "alpha",
	 *     message = "Entered name {{ value }} is invalid."
	 *)
     */
	protected $ime;
    /**
	 * @Assert\NotBlank(
	 *     message = "Email is required."
	 *)
     * @Assert\Email(
     *     message = "The email {{ value }} is not a valid email.",
     *     checkMX = true
     * )
     */
    protected $email;
    /**
     * @Assert\NotBlank(
	 *     message = "Message cannot be empty."
	 *)
     */
    protected $poruka;

    public function setIme($ime)
    {
        $this->ime = $ime;

        return $this;
    }

    public function getIme()
    {
        return $this->ime;
    }
	
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPoruka($poruka)
    {
        $this->poruka = $poruka;

        return $this;
    }

    public function getPoruka()
    {
        return $this->poruka;
    }
}
