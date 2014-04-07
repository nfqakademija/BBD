<?php

namespace NFQAkademija\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductQuantity
 *
 * @ORM\Table(name="product_quantities")
 * @ORM\Entity
 */
class ProductQuantity
{
    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="\NFQAkademija\BaseBundle\Entity\Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false)
     */
    protected $product;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="\NFQAkademija\BaseBundle\Entity\ShoppingList")
     * @ORM\JoinColumn(name="shopping_list_id", referencedColumnName="id", nullable=false)
     */
    protected $shopingList;

    /**
     * @var integer
     */
    protected $quantity;

}
