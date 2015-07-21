<?php
// src/AppBundle/Entity/Users.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

// @Assert\NotBlank()
/**
 * @ORM\Entity
 * @UniqueEntity(fields="email", message="Email already taken")
 * 
 */
class Users
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
	 *
     */
	protected $id;
	
	/**
     * @ORM\Column(type="string", length=100)
	 * @Assert\NotBlank()
     */
	protected $firstName;
	
	/**
     * @ORM\Column(type="string", length=100)
	 * @Assert\NotBlank()
     */
	protected $lastName;
	/**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
	protected $email;
	/**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max = 4096)
     */
	protected $plainPassword;
	
	/**
	 * 
	 * @ORM\Column(type="datetime", name="created_at")
	 * 
	 * 
	 */
	protected $createdat;
	
	/**
	 * 
	 * @ORM\Column(type="datetime", name="updated_at")
	 * 
	 * 
	 */
	protected $updatedat;
	
	public function getFirstName()
    {
        return $this->firstName;
    }
	
	public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }
	
	public function getLastName()
    {
        return $this->lastName;
    }
	
	public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
	
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
     * Set createdat
     *
     * @param \DateTime $createdat
     * @return Users
     */
    public function setCreatedat($createdat)
    {
        $this->createdat = $createdat;

        return $this;
    }
    
    /**
     * Get createdat
     *
     * @return \DateTime 
     */
    public function getCreatedat()
    {
        return $this->createdat;
    }

    /**
     * Set updatedat
     *
     * @param \DateTime $updatedat
     * @return Users
     */
    public function setUpdatedat($updatedat)
    {
        $this->updatedat = $updatedat;

        return $this;
    }
    
    /**
     * Get updatedat
     *
     * @return \DateTime 
     */
    public function getUpdatedat()
    {
        return $this->updatedat;
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
