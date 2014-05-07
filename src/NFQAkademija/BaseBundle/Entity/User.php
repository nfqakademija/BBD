<?php

namespace NFQAkademija\BaseBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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

    /** @ORM\Column(name="google_id", type="string", length=255, nullable=true) */
    protected $google_id;

    /** @ORM\Column(name="google_access_token", type="string", length=255, nullable=true) */
    protected $google_access_token;

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
     * @ORM\OneToMany(targetEntity="\NFQAkademija\BaseBundle\Entity\Step", mappedBy="user")
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

    /**
     * Add shoppingList
     *
     * @param \NFQAkademija\BaseBundle\Entity\ShoppingList $shoppingList
     * @return User
     */


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
     * Set google_id
     *
     * @param string $googleId
     * @return User
     */
    public function setGoogleId($googleId)
    {
        $this->google_id = $googleId;

        return $this;
    }

    /**
     * Get google_id
     *
     * @return string 
     */
    public function getGoogleId()
    {
        return $this->google_id;
    }

    /**
     * Set google_access_token
     *
     * @param string $googleAccessToken
     * @return User
     */
    public function setGoogleAccessToken($googleAccessToken)
    {
        $this->google_access_token = $googleAccessToken;

        return $this;
    }

    /**
     * Get google_access_token
     *
     * @return string 
     */
    public function getGoogleAccessToken()
    {
        return $this->google_access_token;
    }

    /**
     * Add recipe
     *
     * @param \NFQAkademija\BaseBundle\Entity\Step $recipe
     * @return User
     */
    public function addRecipe(\NFQAkademija\BaseBundle\Entity\Step $recipe)
    {
        $this->recipe[] = $recipe;

        return $this;
    }

    /**
     * Remove recipe
     *
     * @param \NFQAkademija\BaseBundle\Entity\Step $recipe
     */
    public function removeRecipe(\NFQAkademija\BaseBundle\Entity\Step $recipe)
    {
        $this->recipe->removeElement($recipe);
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
    public function addComment(\NFQAkademija\BaseBundle\Entity\Comment $comment)
    {
        $this->comment[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \NFQAkademija\BaseBundle\Entity\Comment $comment
     */
    public function removeComment(\NFQAkademija\BaseBundle\Entity\Comment $comment)
    {
        $this->comment->removeElement($comment);
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
    public function addProducedRecipe(\NFQAkademija\BaseBundle\Entity\ProducedRecipe $producedRecipes)
    {
        $this->producedRecipes[] = $producedRecipes;

        return $this;
    }

    /**
     * Remove producedRecipes
     *
     * @param \NFQAkademija\BaseBundle\Entity\ProducedRecipe $producedRecipes
     */
    public function removeProducedRecipe(\NFQAkademija\BaseBundle\Entity\ProducedRecipe $producedRecipes)
    {
        $this->producedRecipes->removeElement($producedRecipes);
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
