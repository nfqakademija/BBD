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
     * @ORM\OneToMany(targetEntity="\NFQAkademija\BaseBundle\Entity\RecipeProduct", mappedBy="product")
     */
    private $recipeProduct;

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
        $this->recipeProduct = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add recipeProduct
     *
     * @param \NFQAkademija\BaseBundle\Entity\RecipeProduct $recipeProduct
     * @return Product
     */
    public function addRecipeProduct(\NFQAkademija\BaseBundle\Entity\RecipeProduct $recipeProduct)
    {
        $this->recipeProduct[] = $recipeProduct;

        return $this;
    }

    /**
     * Remove recipeProduct
     *
     * @param \NFQAkademija\BaseBundle\Entity\RecipeProduct $recipeProduct
     */
    public function removeRecipeProduct(\NFQAkademija\BaseBundle\Entity\RecipeProduct $recipeProduct)
    {
        $this->recipeProduct->removeElement($recipeProduct);
    }

    /**
     * Get recipeProduct
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRecipeProduct()
    {
        return $this->recipeProduct;
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
