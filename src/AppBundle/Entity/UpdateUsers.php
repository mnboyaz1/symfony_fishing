<?php
// src/AppBundle/Entity/UpdateUsers.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity
 * @UniqueEntity(fields="email", message="Email already taken")
 * 
 */
class UpdateUsers
{
	
	/**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Email()
	 */
	public $email;
	
	/**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max = 4096)
     */
	public $plainPassword;
	
	
	public function getEmail()
    {
        return $this->email;
    }
	
	public function setEmail($email)
    {
        $this->email = $email;
    }
	
	public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }
	
}
