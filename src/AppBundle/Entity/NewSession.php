<?php
// src/AppBundle/Entity/NewSession.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
//@UniqueEntity(fields="email", message="Email already taken")
//@Assert\Email()

/**
 * @ORM\Entity
 *
 * 
 */
class NewSession
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
	 *
     */
	protected $id;
	
	/**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * 
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
	
	/**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
