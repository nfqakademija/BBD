<?php

namespace NFQAkademija\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShoppingList
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ShoppingList
{
    /** @ORM\Id() @ORM\Column(type="integer") */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="\NFQAkademija\BaseBundle\Entity\ProductQuantity", mappedBy="product")
     */
    private $products;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="\NFQAkademija\BaseBundle\Entity\User", inversedBy="shoppingList")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * Creates a Doctrine Collection for members.
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return ShoppingList
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Add products
     *
     * @param \NFQAkademija\BaseBundle\Entity\ProductQuantity $products
     * @return ShoppingList
     */
    public function addProduct(\NFQAkademija\BaseBundle\Entity\ProductQuantity $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param \NFQAkademija\BaseBundle\Entity\ProductQuantity $products
     */
    public function removeProduct(\NFQAkademija\BaseBundle\Entity\ProductQuantity $products)
    {
        $this->products->removeElement($products);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set user
     *
     * @param \NFQAkademija\BaseBundle\Entity\User $user
     * @return ShoppingList
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
}
