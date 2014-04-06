<?php

namespace NFQAkademija\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recipe
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="NFQAkademija\BaseBundle\Entity\RecipeRepository")
 */
class Recipe
{
//  /**
//     * @ORM\ManyToMany(targetEntity="Product", mappedBy="recipes")
//     */
//   private $products;
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
     * @ORM\Column(name="RecipeId", type="integer")
     */
    private $recipeId;

    /**
     * @var string
     *
     * @ORM\Column(name="RecipeName", type="string", length=255)
     */
    private $recipeName;

    /**
     * @var string
     *
     * @ORM\Column(name="RecipeDescription", type="string", length=255)
     */
    private $recipeDescription;

    /**
     * @var float
     *
     * @ORM\Column(name="Rating", type="float")
     */
    private $rating;

    /**
     * @var integer
     *
     * @ORM\Column(name="Raters", type="integer")
     */
    private $raters;

    /**
     * @var string
     *
     * @ORM\Column(name="RecipePhoto", type="string", length=255)
     */
    private $recipePhoto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CreationDate", type="datetime")
     */
    private $creationDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="CountryId", type="integer")
     */
    private $countryId;

    /**
     * @var integer
     *
     * @ORM\Column(name="CreatorId", type="integer")
     */
    private $creatorId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CookingDuration", type="time")
     */
    private $cookingDuration;
    /**
     * Creates a Doctrine Collection for members.
     */
    /**
     * @ORM\OneToMany(targetEntity="NFQAkademija\BaseBundle\Entity\Product", mappedBy="recipe")
     */
    protected $products;
    /**
     * @ORM\OneToMany(targetEntity="NFQAkademija\BaseBundle\Entity\Property", mappedBy="recipe")
     */
    protected $properties;

    /**
     * Creates a Doctrine Collection for members.
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
        $this->properties = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set recipeId
     *
     * @param integer $recipeId
     * @return Recipe
     */
    public function setRecipeId($recipeId)
    {
        $this->recipeId = $recipeId;

        return $this;
    }

    /**
     * Get recipeId
     *
     * @return integer 
     */
    public function getRecipeId()
    {
        return $this->recipeId;
    }

    /**
     * Set recipeName
     *
     * @param string $recipeName
     * @return Recipe
     */
    public function setRecipeName($recipeName)
    {
        $this->recipeName = $recipeName;

        return $this;
    }

    /**
     * Get recipeName
     *
     * @return string 
     */
    public function getRecipeName()
    {
        return $this->recipeName;
    }

    /**
     * Set recipeDescription
     *
     * @param string $recipeDescription
     * @return Recipe
     */
    public function setRecipeDescription($recipeDescription)
    {
        $this->recipeDescription = $recipeDescription;

        return $this;
    }

    /**
     * Get recipeDescription
     *
     * @return string 
     */
    public function getRecipeDescription()
    {
        return $this->recipeDescription;
    }

    /**
     * Set rating
     *
     * @param float $rating
     * @return Recipe
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return float 
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set raters
     *
     * @param integer $raters
     * @return Recipe
     */
    public function setRaters($raters)
    {
        $this->raters = $raters;

        return $this;
    }

    /**
     * Get raters
     *
     * @return integer 
     */
    public function getRaters()
    {
        return $this->raters;
    }

    /**
     * Set recipePhoto
     *
     * @param string $recipePhoto
     * @return Recipe
     */
    public function setRecipePhoto($recipePhoto)
    {
        $this->recipePhoto = $recipePhoto;

        return $this;
    }

    /**
     * Get recipePhoto
     *
     * @return string 
     */
    public function getRecipePhoto()
    {
        return $this->recipePhoto;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return Recipe
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime 
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set countryId
     *
     * @param integer $countryId
     * @return Recipe
     */
    public function setCountryId($countryId)
    {
        $this->countryId = $countryId;

        return $this;
    }

    /**
     * Get countryId
     *
     * @return integer 
     */
    public function getCountryId()
    {
        return $this->countryId;
    }

    /**
     * Set creatorId
     *
     * @param integer $creatorId
     * @return Recipe
     */
    public function setCreatorId($creatorId)
    {
        $this->creatorId = $creatorId;

        return $this;
    }

    /**
     * Get creatorId
     *
     * @return integer 
     */
    public function getCreatorId()
    {
        return $this->creatorId;
    }

    /**
     * Set cookingDuration
     *
     * @param \DateTime $cookingDuration
     * @return Recipe
     */
    public function setCookingDuration($cookingDuration)
    {
        $this->cookingDuration = $cookingDuration;

        return $this;
    }

    /**
     * Get cookingDuration
     *
     * @return \DateTime 
     */
    public function getCookingDuration()
    {
        return $this->cookingDuration;
    }
}
