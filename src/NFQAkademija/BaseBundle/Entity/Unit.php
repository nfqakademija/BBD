<?php

namespace NFQAkademija\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Unit
 *
 * @ORM\Table(name="units")
 * @ORM\Entity
 */
class Unit
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=4)
     */
    private $name;
    /**
     * @ORM\OneToMany(targetEntity="\NFQAkademija\BaseBundle\Entity\Product", mappedBy="unit")
     */
    protected $product;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->product = new \Doctrine\Common\Collections\ArrayCollection();
    }
    public function __toString(){
        return $this->getName();
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

    /**
     * Set name
     *
     * @param string $name
     * @return Unit
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add product
     *
     * @param \NFQAkademija\BaseBundle\Entity\Product $product
     * @return Unit
     */
    public function addProduct(\NFQAkademija\BaseBundle\Entity\Product $product)
    {
        $this->product[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \NFQAkademija\BaseBundle\Entity\Product $product
     */
    public function removeProduct(\NFQAkademija\BaseBundle\Entity\Product $product)
    {
        $this->product->removeElement($product);
    }

    /**
     * Get product
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProduct()
    {
        return $this->product;
    }
}
