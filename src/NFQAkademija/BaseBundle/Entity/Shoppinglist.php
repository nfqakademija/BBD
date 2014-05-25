<?php

namespace NFQAkademija\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shoppinglist
 *
 * @ORM\Table(name="shoppinglists")
 * @ORM\Entity
 */

class Shoppinglist
{
    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="\NFQAkademija\BaseBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $user;
    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="\NFQAkademija\BaseBundle\Entity\Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false)
     */
    protected $product;


    /**
     * @var integer
     *  @ORM\Column(name="quantity", type="integer")
     */
    protected $quantity;

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return Shoppinglist
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
     * Set user
     *
     * @param \NFQAkademija\BaseBundle\Entity\User $user
     * @return Product
     */
    public function setUser(\NFQAkademija\BaseBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \NFQAkademija\BaseBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set product
     *
     * @param \NFQAkademija\BaseBundle\Entity\Product $product
     * @return Product
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
}
