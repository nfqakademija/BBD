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
}
