<?php

namespace NFQAkademija\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="products")
 * @ORM\Entity
 */
class Product
{
    /**
     * @ORM\OneToMany(targetEntity="\NFQAkademija\BaseBundle\Entity\ShoppingListProduct", mappedBy="product")
     */
    private $shoppingListProduct;

    /**
     * @var integer
     *
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255)
     */
    private $photo;
    /**
     * @ORM\ManyToOne(targetEntity="\NFQAkademija\BaseBundle\Entity\Category")
     */
    private $category;
    /**
     * @ORM\ManyToOne(targetEntity="\NFQAkademija\BaseBundle\Entity\Unit")
     */
    private $unit;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->shoppingListProduct = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Product
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
     * Set photo
     *
     * @param string $photo
     * @return Product
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Add shoppingListProduct
     *
     * @param \NFQAkademija\BaseBundle\Entity\ShoppingListProduct $shoppingListProduct
     * @return Product
     */
    public function addShoppingListProduct(\NFQAkademija\BaseBundle\Entity\ShoppingListProduct $shoppingListProduct)
    {
        $this->shoppingListProduct[] = $shoppingListProduct;

        return $this;
    }

    /**
     * Remove shoppingListProduct
     *
     * @param \NFQAkademija\BaseBundle\Entity\ShoppingListProduct $shoppingListProduct
     */
    public function removeShoppingListProduct(\NFQAkademija\BaseBundle\Entity\ShoppingListProduct $shoppingListProduct)
    {
        $this->shoppingListProduct->removeElement($shoppingListProduct);
    }

    /**
     * Get shoppingListProduct
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getShoppingListProduct()
    {
        return $this->shoppingListProduct;
    }

    /**
     * Set category
     *
     * @param \NFQAkademija\BaseBundle\Entity\Category $category
     * @return Product
     */
    public function setCategory(\NFQAkademija\BaseBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \NFQAkademija\BaseBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set unit
     *
     * @param \NFQAkademija\BaseBundle\Entity\Unit $unit
     * @return Product
     */
    public function setUnit(\NFQAkademija\BaseBundle\Entity\Unit $unit = null)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return \NFQAkademija\BaseBundle\Entity\Unit 
     */
    public function getUnit()
    {
        return $this->unit;
    }
}
