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
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ORM\Column(name="facebook_id", type="string", length=255, nullable=true) */
    protected $facebook_id;

    /** @ORM\Column(name="facebook_access_token", type="string", length=255, nullable=true) */
    protected $facebook_access_token;
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
     * @var \NFQAkademija\BaseBundle\Entity\Shoppinglist
     * @ORM\OneToMany(targetEntity="\NFQAkademija\BaseBundle\Entity\Shoppinglist", mappedBy="user")
     */
    protected $shoppingList;
    /**
     * @ORM\OneToMany(targetEntity="\NFQAkademija\BaseBundle\Entity\Recipe", mappedBy="user")
     */
    protected $recipe;
    /**
     * @ORM\OneToMany(targetEntity="\NFQAkademija\BaseBundle\Entity\Comment", mappedBy="user")
     */
    protected $comment;
    /**
     * @ORM\OneToMany(targetEntity="\NFQAkademija\BaseBundle\Entity\ProducedRecipe", mappedBy="user")
     */
    protected $producedRecipes;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->shoppingList = new \Doctrine\Common\Collections\ArrayCollection();
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $this->enabled = false;
        $this->locked = false;
        $this->expired = false;
        $this->roles = array();
        $this->credentialsExpired = false;
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
     * Set facebook_id
     *
     * @param string $facebookId
     * @return User
     */
    public function setFacebookId($facebookId)
    {
        $this->facebook_id = $facebookId;

        return $this;
    }

    /**
     * Get facebook_id
     *
     * @return string 
     */
    public function getFacebookId()
    {
        return $this->facebook_id;
    }

    /**
     * Set facebook_access_token
     *
     * @param string $facebookAccessToken
     * @return User
     */
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebook_access_token = $facebookAccessToken;

        return $this;
    }

    /**
     * Get facebook_access_token
     *
     * @return string 
     */
    public function getFacebookAccessToken()
    {
        return $this->facebook_access_token;
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
    public function addShoppingList(ShoppingList $shoppingList)
    {
        $this->shoppingList[] = $shoppingList;

        return $this;
    }

    /**
     * Remove shoppingList
     *
     * @param \NFQAkademija\BaseBundle\Entity\ShoppingList $shoppingList
     */
    public function removeShoppingList(ShoppingList $shoppingList)
    {
        /** @var $shoppingList ShoppingList */
        $this->removeShoppingList($shoppingList);
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

    /**
     * Add recipe
     *
     * @param \NFQAkademija\BaseBundle\Entity\Recipe $recipe
     * @return User
     */
    public function addRecipe(Recipe $recipe)
    {
        $this->recipe[] = $recipe;

        return $this;
    }

    /**
     * Remove recipe
     *
     * @param \NFQAkademija\BaseBundle\Entity\Step $recipe
     */
    public function removeRecipe(Recipe $recipe)
    {

        /** @var $recipe Recipe */
        $this->removeRecipe($recipe);
    }

    /**
     * Get recipe
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRecipe()
    {
        return $this->recipe;
    }

    /**
     * Add comment
     *
     * @param \NFQAkademija\BaseBundle\Entity\Comment $comment
     * @return User
     */
    public function addComment(Comment $comment)
    {
        $this->comment[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \NFQAkademija\BaseBundle\Entity\Comment $comment
     */
    public function removeComment(Comment $comment)
    {
        /** @var $comment Comment */
        $this->removeComment($comment);
    }

    /**
     * Get comment
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Add producedRecipes
     *
     * @param \NFQAkademija\BaseBundle\Entity\ProducedRecipe $producedRecipes
     * @return User
     */
    public function addProducedRecipe(ProducedRecipe $producedRecipes)
    {
        $this->producedRecipes[] = $producedRecipes;

        return $this;
    }

    /**
     * Remove producedRecipes
     *
     * @param \NFQAkademija\BaseBundle\Entity\ProducedRecipe $producedRecipes
     */
    public function removeProducedRecipe(ProducedRecipe $producedRecipes)
    {
        /** @var $producedRecipes ProducedRecipe */
        $this->removeProducedRecipe($producedRecipes);
    }

    /**
     * Get producedRecipes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProducedRecipes()
    {
        return $this->producedRecipes;
    }
}
