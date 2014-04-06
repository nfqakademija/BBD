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
    /**
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="shoppingLists")
     */
    private $products;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="ShoppingListId", type="integer")
     */
    private $shoppingListId;

    /**
     * @var integer
     *
     * @ORM\Column(name="UserId", type="integer")
     */
    private $userId;
    /**
     * Creates a Doctrine Collection for members.
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set shoppingListId
     *
     * @param integer $shoppingListId
     * @return ShoppingList
     */
    public function setShoppingListId($shoppingListId)
    {
        $this->shoppingListId = $shoppingListId;

        return $this;
    }

    /**
     * Get shoppingListId
     *
     * @return integer 
     */
    public function getShoppingListId()
    {
        return $this->shoppingListId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return ShoppingList
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
