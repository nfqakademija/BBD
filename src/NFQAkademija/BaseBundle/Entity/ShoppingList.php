<?php

namespace NFQAkademija\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShoppingList
 *
 * @ORM\Table(name="shopping_list")
 * @ORM\Entity
 */
class ShoppingList
{
    /** @ORM\Id() @ORM\Column(type="integer") */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="\NFQAkademija\BaseBundle\Entity\ShoppingListProduct", mappedBy="shopingList")
     */
    protected $products;
    /**
     * @ORM\ManyToOne(targetEntity="\NFQAkademija\BaseBundle\Entity\User")
     */
    protected $user;

    /**
     * Creates a Doctrine Collection for members.
     */
    public function __construct()
    {
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
     * @param \NFQAkademija\BaseBundle\Entity\ShoppingListProduct $products
     * @return ShoppingList
     */
    public function addProduct(ShoppingListProduct $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param \NFQAkademija\BaseBundle\Entity\ShoppingListProduct $products
     */
    public function removeProduct(ShoppingListProduct $products)
    {
        /** @var $products ShoppingListProduct */
        $this->removeProduct($products);
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
    public function setUser(\NFQAkademija\BaseBundle\Entity\User $user = null)
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
