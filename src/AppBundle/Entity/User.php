<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use AppBundle\Validator\Constraints\ValidateCity;
use AppBundle\Validator\Constraints\ValidateZipcode;

/**
 * User
 * 
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ValidateCity
 * @ValidateZipcode
 */
class User extends BaseUser
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
     * @Assert\Length(
     *      min = 8,
     *      max = 16,
     *      minMessage = "Password must be at least {{ limit }} characters long",
     *      maxMessage = "Password cannot be longer than {{ limit }} characters"
     * )
     * @Assert\Regex(
     * 		pattern ="/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$/",
     * 		message = "Must contain at least one lowercase letter, at least one uppercase letter, at least one number and at least one special character"
     * )
     * @Assert\NotBlank(
     * 		message = "Please enter your Password"
     * )
     */
    protected $plainPassword;

    /**
     * @var string
     * 
     * @Assert\NotBlank(
     * 		message = "Please enter your FirstName"
     * )
     * @ORM\Column(name="first_name", type="string", length=50)
     */
    protected $firstName;

    /**
     * @var string
     * 
     * @Assert\NotBlank(
     * 		message = "Please enter your LastName"
     * )
     * @ORM\Column(name="last_name", type="string", length=50)
     */
    protected $lastName;
    
    /**
     * @var string
     * 
     * @Assert\NotBlank(
     * 		message = "Please enter your Address"
     * )
     * @ORM\Column(name="address_1", type="string", length=200)
     */
    protected $address1;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="address_2", type="string", length=200, nullable=true)
     */
    protected $address2 = null;

    /**
     * @var string
     * 
     * @Assert\NotBlank(
     * 		message = "Please enter your City"
     * )
     * @ORM\Column(type="string", length=50)
     */
    protected $city;

    /**
     * @var string
     * 
     * @Assert\NotBlank(
     * 		message = "Please enter your State"
     * )
     * @ORM\Column(type="string", length=2)
     */
    protected $state;

    /**
     * @var string
     * 
     * @Assert\Regex(
     * 		pattern ="/^\d{5}$/",
     * 		message = "Must be a valid Zipcode"
     * )
     * @Assert\NotBlank(
     * 		message = "Please enter your Zipcode"
     * )
     * @ORM\Column(name="zipcode", type="string", length=5)
     */
    protected $zip;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=2)
     */
    protected $country;
    
    /**
     * @var datetime
     * 
     * @ORM\Column(type="datetime")
     */
    protected $lastModified;

    public function __construct()
    {
		parent::__construct();
        $this->lastModified = new \DateTime();
        $this->country = "US";
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
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
     *
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
     * Set plainPassword
     *
     * @param string $plainPassword
     *
     * @return string
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    /**
     * Get plainPassword
     *
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * Set email
     *
     * @param string $email
     *
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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set firstName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }
    
    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Get address1
     *
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set address1
     *
     * @param string $address1
     *
     * @return User
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;
        return $this;
    }

    /**
     * Get address2
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set address1
     *
     * @param string $address2
     *
     * @return User
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return User
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * Get zip
     *
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set zip
     *
     * @param string $zip
     *
     * @return User
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return User
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * Get lastModified
     *
     * @return datetime
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * Set lastModified
     *
     * @param string $lastModified
     *
     * @return User
     */
    public function setLastModified($lastModified)
    {
        $this->lastModified = $lastModified;
        return $this;
    }

}

