<?php

namespace NFQAkademija\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserFridge
 *
 * @ORM\Table(name="user_fridge")
 * @ORM\Entity
 */
class UserFridge
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var \NFQAkademija\BaseBundle\Entity\User
     * @ORM\OneToMany(targetEntity="\NFQAkademija\BaseBundle\Entity\User", mappedBy="userFrige")
     */
    protected $users;

    /**
     * @ORM\OneToMany(targetEntity="\NFQAkademija\BaseBundle\Entity\UserProduct", mappedBy="userFridge")
     */
    protected $products;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add users
     *
     * @param \NFQAkademija\BaseBundle\Entity\User $users
     * @return UserFridge
     */
    public function addUser(\NFQAkademija\BaseBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \NFQAkademija\BaseBundle\Entity\User $users
     */
    public function removeUser(\NFQAkademija\BaseBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add products
     *
     * @param \NFQAkademija\BaseBundle\Entity\UserProduct $products
     * @return UserFridge
     */
    public function addProduct(\NFQAkademija\BaseBundle\Entity\UserProduct $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param \NFQAkademija\BaseBundle\Entity\UserProduct $products
     */
    public function removeProduct(\NFQAkademija\BaseBundle\Entity\UserProduct $products)
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
