<?php

namespace NFQAkademija\BaseBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="NFQAkademija\BaseBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255, nullable=true)
     */
    protected $surname;


    /**
     * @var \NFQAkademija\BaseBundle\Entity\ShoppingList
     * @ORM\OneToMany(targetEntity="\NFQAkademija\BaseBundle\Entity\ShoppingList", mappedBy="user")
     */
    protected $shoppingList;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->shoppingList = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Add shoppingList
     *
     * @param \NFQAkademija\BaseBundle\Entity\ShoppingList $shoppingList
     * @return User
     */
    public function addShoppingList(\NFQAkademija\BaseBundle\Entity\ShoppingList $shoppingList)
    {
        $this->shoppingList[] = $shoppingList;

        return $this;
    }

    /**
     * Remove shoppingList
     *
     * @param \NFQAkademija\BaseBundle\Entity\ShoppingList $shoppingList
     */
    public function removeShoppingList(\NFQAkademija\BaseBundle\Entity\ShoppingList $shoppingList)
    {
        $this->shoppingList->removeElement($shoppingList);
    }

    /**
     * Get shoppingList
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getShoppingList()
    {
        return $this->shoppingList;
    }
}
