<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * ChangePassword
 */
class ChangePassword
{
    /**
     * @var array
     *
	 * @Assert\NotBlank(
	 *     message = "Password is required."
	 *)
     */
    private $password;


    /**
     * Set password
     *
     * @param array $password
     * @return ChangePassword
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return array 
     */
    public function getPassword()
    {
        return $this->password;
    }
}
