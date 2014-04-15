<?php

namespace NFQAkademija\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecipeProduct
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class RecipeProduct
{
    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="\NFQAkademija\BaseBundle\Entity\Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false)
     */
    protected $product;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    protected $quantity;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="\NFQAkademija\BaseBundle\Entity\Recipe")
     * @ORM\JoinColumn(name="recipe_id", referencedColumnName="id", nullable=false)
     */
    protected $recipe;


    /**
     * Set product
     *
     * @param \NFQAkademija\BaseBundle\Entity\Product $product
     * @return RecipeProduct
     */
    public function setProduct(\NFQAkademija\BaseBundle\Entity\Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \NFQAkademija\BaseBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return RecipeProduct
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set recipe
     *
     * @param \NFQAkademija\BaseBundle\Entity\Recipe $recipe
     * @return RecipeProduct
     */
    public function setRecipe(\NFQAkademija\BaseBundle\Entity\Recipe $recipe)
    {
        $this->recipe = $recipe;

        return $this;
    }

    /**
     * Get recipe
     *
     * @return \NFQAkademija\BaseBundle\Entity\Recipe
     */
    public function getRecipe()
    {
        return $this->recipe;
    }
}
