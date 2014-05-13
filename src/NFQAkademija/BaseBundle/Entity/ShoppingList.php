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
    public function addProduct(\NFQAkademija\BaseBundle\Entity\ShoppingListProduct $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param \NFQAkademija\BaseBundle\Entity\ShoppingListProduct $products
     */
    public function removeProduct(\NFQAkademija\BaseBundle\Entity\ShoppingListProduct $products)
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
}
