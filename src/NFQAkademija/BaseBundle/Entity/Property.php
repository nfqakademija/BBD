<?php

namespace NFQAkademija\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Property
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Property
{
    /**
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="properties")
     */
    private $products;
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
     * @ORM\Column(name="PropertyId", type="integer")
     */
    private $propertyId;

    /**
     * @var string
     *
     * @ORM\Column(name="PropertyName", type="string", length=255)
     */
    private $propertyName;

    /**
     * @var string
     *
     * @ORM\Column(name="PropertyPhoto", type="string", length=255)
     */
    private $propertyPhoto;


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
     * Set propertyId
     *
     * @param integer $propertyId
     * @return Property
     */
    public function setPropertyId($propertyId)
    {
        $this->propertyId = $propertyId;

        return $this;
    }

    /**
     * Get propertyId
     *
     * @return integer 
     */
    public function getPropertyId()
    {
        return $this->propertyId;
    }

    /**
     * Set propertyName
     *
     * @param string $propertyName
     * @return Property
     */
    public function setPropertyName($propertyName)
    {
        $this->propertyName = $propertyName;

        return $this;
    }

    /**
     * Get propertyName
     *
     * @return string 
     */
    public function getPropertyName()
    {
        return $this->propertyName;
    }

    /**
     * Set propertyPhoto
     *
     * @param string $propertyPhoto
     * @return Property
     */
    public function setPropertyPhoto($propertyPhoto)
    {
        $this->propertyPhoto = $propertyPhoto;

        return $this;
    }

    /**
     * Get propertyPhoto
     *
     * @return string 
     */
    public function getPropertyPhoto()
    {
        return $this->propertyPhoto;
    }
}
