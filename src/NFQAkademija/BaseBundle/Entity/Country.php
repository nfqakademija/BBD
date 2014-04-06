<?php

namespace NFQAkademija\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Country
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="CountryId", type="integer")
     */
    private $countryId;

    /**
     * @var string
     *
     * @ORM\Column(name="CountryName", type="string", length=255)
     */
    private $countryName;

    /**
     * @var string
     *
     * @ORM\Column(name="CountryFlag", type="string", length=255)
     */
    private $countryFlag;


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
     * Set countryId
     *
     * @param integer $countryId
     * @return Country
     */
    public function setCountryId($countryId)
    {
        $this->countryId = $countryId;

        return $this;
    }

    /**
     * Get countryId
     *
     * @return integer 
     */
    public function getCountryId()
    {
        return $this->countryId;
    }

    /**
     * Set countryName
     *
     * @param string $countryName
     * @return Country
     */
    public function setCountryName($countryName)
    {
        $this->countryName = $countryName;

        return $this;
    }

    /**
     * Get countryName
     *
     * @return string 
     */
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * Set countryFlag
     *
     * @param string $countryFlag
     * @return Country
     */
    public function setCountryFlag($countryFlag)
    {
        $this->countryFlag = $countryFlag;

        return $this;
    }

    /**
     * Get countryFlag
     *
     * @return string 
     */
    public function getCountryFlag()
    {
        return $this->countryFlag;
    }
}
