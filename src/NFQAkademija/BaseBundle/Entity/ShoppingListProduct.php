<?php

namespace NFQAkademija\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductQuantity
 *
 * @ORM\Table(name="product_quantities")
 * @ORM\Entity
 */
class ShoppingListProduct
{
    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="\NFQAkademija\BaseBundle\Entity\Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false)
     */
    protected $product;

    /**
     * @var integer
     */
    protected $quantity;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="\NFQAkademija\BaseBundle\Entity\ShoppingList")
     * @ORM\JoinColumn(name="shopping_list_id", referencedColumnName="id", nullable=false)
     */
    protected $shopingList;



    /**
     * Set product
     *
     * @param \NFQAkademija\BaseBundle\Entity\Product $product
     * @return ShoppingListProduct
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
     * Set shopingList
     *
     * @param \NFQAkademija\BaseBundle\Entity\ShoppingList $shopingList
     * @return ShoppingListProduct
     */
    public function setShopingList(\NFQAkademija\BaseBundle\Entity\ShoppingList $shopingList)
    {
        $this->shopingList = $shopingList;

        return $this;
    }

    /**
     * Get shopingList
     *
     * @return \NFQAkademija\BaseBundle\Entity\ShoppingList 
     */
    public function getShopingList()
    {
        return $this->shopingList;
    }
}
