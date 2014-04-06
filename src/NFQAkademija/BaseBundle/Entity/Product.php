<?php

namespace NFQAkademija\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Product
{


    /**
     * @ORM\ManyToMany(targetEntity="Property", inversedBy="products")
     * @ORM\JoinTable(name="product_properties")
     */
    private $properties;
    /**
     * @ORM\ManyToMany(targetEntity="ShoppingList", inversedBy="products")
     * @ORM\JoinTable(name="product_shoppingLists")
     */
    private $shoppingLists;
    /**
     * @ORM\ManyToMany(targetEntity="Recipe", inversedBy="products")
     * @ORM\JoinTable(name="product_recipes")
     */
    private $recipes;
    /**
     * @var integer
     *
     * @ORM\Column(name="ProductId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ProductName", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="CategoryId", type="integer")
     */
    private $categoryId;

    /**
     * @var string
     *
     * @ORM\Column(name="ProductPhoto", type="string", length=255)
     */
    private $photo;


    /**
     * Get ProductId
     *
     * @return integer 
     */
    public function getProductId()
    {
        return $this->ProductId;
    }

    /**
     * Set ProductName
     *
     * @param string $ProductName
     * @return Product
     */
    public function setProductName($ProductName)
    {
        $this->name = $ProductName;

        return $this;
    }

    /**
     * Get ProductName
     *
     * @return string 
     */
    public function getProductName()
    {
        return $this->ProductName;
    }

    /**
     * Set categoryId
     *
     * @param integer $categoryId
     * @return Product
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer 
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set ProductPhoto
     *
     * @param string $ProductPhoto
     * @return Product
     */
    public function setProductPhoto($ProductPhoto)
    {
        $this->photo = $ProductPhoto;

        return $this;
    }

    /**
     * Get ProductPhoto
     *
     * @return string 
     */
    public function getProductPhoto()
    {
        return $this->ProductPhoto;
    }
}
