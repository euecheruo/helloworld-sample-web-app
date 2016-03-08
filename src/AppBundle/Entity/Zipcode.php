<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Zipcode
 *
 * @ORM\Table(name="zipcodes")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ZipcodeRepository")
 */
class Zipcode
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
     * @ORM\Column(name="code", type="string", length=5)
     */
    protected $code;

    /**
     * @var integer
     *
     * @ORM\Column(name="city_id", type="integer")
     */
    protected $cityId;

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
     * Set code
     *
     * @param string $code
     *
     * @return Zipcode
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }


    /**
     * Set cityId
     *
     * @param integer $cityId
     *
     * @return Zipcode
     */
    public function setCityId($cityId)
    {
        $this->cityId = $cityId;
        return $this;
    }

    /**
     * Get cityId
     *
     * @return integer
     */
    public function getCityId()
    {
        return $this->cityId;
    }

}
