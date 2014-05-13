<?php

namespace NFQAkademija\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recipe
 *
 * @ORM\Table(name="recipes")
 * @ORM\Entity(repositoryClass="NFQAkademija\BaseBundle\Entity\RecipeRepository")
 */
class Recipe
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255)
     */
    private $photo;

    /**
     * @ORM\ManyToMany(targetEntity="\NFQAkademija\BaseBundle\Entity\Property", inversedBy="recipes")
     * @ORM\JoinTable(name="recipe_property")
     **/
    protected $properties;

    /**
     * @ORM\ManyToOne(targetEntity="\NFQAkademija\BaseBundle\Entity\Country")
     */
    private $country;
    /**
     * @ORM\ManyToOne(targetEntity="\NFQAkademija\BaseBundle\Entity\Celebration")
     */
    private $celebration;
    /**
     * @ORM\ManyToOne(targetEntity="\NFQAkademija\BaseBundle\Entity\CookingTime")
     */
    protected $cookingTime;
    /**
     * @ORM\ManyToOne(targetEntity="\NFQAkademija\BaseBundle\Entity\MainCookingMethod")
     */
    protected $mainCookingMethod;
    /**
     * @ORM\ManyToOne(targetEntity="\NFQAkademija\BaseBundle\Entity\Type")
     */
    protected $types;
    /**
     * @ORM\ManyToOne(targetEntity="\NFQAkademija\BaseBundle\Entity\User")
     */
    protected $user;
    /**
     * @ORM\OneToMany(targetEntity="\NFQAkademija\BaseBundle\Entity\Step", mappedBy="recipe")
     */
    protected $steps;

    /**
     * @ORM\OneToMany(targetEntity="\NFQAkademija\BaseBundle\Entity\RecipeProduct", mappedBy="recipe")
     */
    protected $products;
    /**
     * @ORM\OneToMany(targetEntity="\NFQAkademija\BaseBundle\Entity\Like", mappedBy="recipe")
     */
    protected $likes;
    /**
     * @ORM\OneToMany(targetEntity="\NFQAkademija\BaseBundle\Entity\ProducedRecipe", mappedBy="recipe")
     */
    protected $producedRecipes;

    /**
     * @ORM\OneToMany(targetEntity="\NFQAkademija\BaseBundle\Entity\RecipeProduct", mappedBy="recipe")
     */
    protected $recipeProducts;

    /**
     * Creates a Doctrine Collection for members.
     */
    public function __construct()
    {
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
     * @return Recipe
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
     * Set description
     *
     * @param string $description
     * @return Recipe
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return Recipe
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Add properties
     *
     * @param \NFQAkademija\BaseBundle\Entity\Property $properties
     * @return Recipe
     */
    public function addProperty(\NFQAkademija\BaseBundle\Entity\Property $properties)
    {
        $this->properties[] = $properties;

        return $this;
    }

    /**
     * Remove properties
     *
     * @param \NFQAkademija\BaseBundle\Entity\Property $properties
     */
    public function removeProperty(\NFQAkademija\BaseBundle\Entity\Property $properties)
    {
        $this->removeProperty($properties);
    }

    /**
     * Get properties
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Set country
     *
     * @param \NFQAkademija\BaseBundle\Entity\Country $country
     * @return Recipe
     */
    public function setCountry(\NFQAkademija\BaseBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \NFQAkademija\BaseBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set celebration
     *
     * @param \NFQAkademija\BaseBundle\Entity\Celebration $celebration
     * @return Recipe
     */
    public function setCelebration(\NFQAkademija\BaseBundle\Entity\Celebration $celebration = null)
    {
        $this->celebration = $celebration;

        return $this;
    }

    /**
     * Get celebration
     *
     * @return \NFQAkademija\BaseBundle\Entity\Celebration
     */
    public function getCelebration()
    {
        return $this->celebration;
    }

    /**
     * Set cookingTime
     *
     * @param \NFQAkademija\BaseBundle\Entity\CookingTime $cookingTime
     * @return Recipe
     */
    public function setCookingTime(\NFQAkademija\BaseBundle\Entity\CookingTime $cookingTime = null)
    {
        $this->cookingTime = $cookingTime;

        return $this;
    }

    /**
     * Get cookingTime
     *
     * @return \NFQAkademija\BaseBundle\Entity\CookingTime
     */
    public function getCookingTime()
    {
        return $this->cookingTime;
    }

    /**
     * Set mainCookingMethod
     *
     * @param \NFQAkademija\BaseBundle\Entity\MainCookingMethod $mainCookingMethod
     * @return Recipe
     */
    public function setMainCookingMethod(\NFQAkademija\BaseBundle\Entity\MainCookingMethod $mainCookingMethod = null)
    {
        $this->mainCookingMethod = $mainCookingMethod;

        return $this;
    }

    /**
     * Get mainCookingMethod
     *
     * @return \NFQAkademija\BaseBundle\Entity\MainCookingMethod
     */
    public function getMainCookingMethod()
    {
        return $this->mainCookingMethod;
    }

    /**
     * Set types
     *
     * @param \NFQAkademija\BaseBundle\Entity\Type $types
     * @return Recipe
     */
    public function setTypes(\NFQAkademija\BaseBundle\Entity\Type $types = null)
    {
        $this->types = $types;

        return $this;
    }

    /**
     * Get types
     *
     * @return \NFQAkademija\BaseBundle\Entity\Type
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * Set user
     *
     * @param \NFQAkademija\BaseBundle\Entity\User $user
     * @return Recipe
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

    /**
     * Add steps
     *
     * @param \NFQAkademija\BaseBundle\Entity\Step $steps
     * @return Recipe
     */
    public function addStep(\NFQAkademija\BaseBundle\Entity\Step $steps)
    {
        $this->steps[] = $steps;

        return $this;
    }

    /**
     * Remove steps
     *
     * @param \NFQAkademija\BaseBundle\Entity\Step $steps
     */
    public function removeStep(\NFQAkademija\BaseBundle\Entity\Step $steps)
    {
        $this->removeStep($steps);
    }

    /**
     * Get steps
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSteps()
    {
        return $this->steps;
    }

    /**
     * Add products
     *
     * @param \NFQAkademija\BaseBundle\Entity\RecipeProduct $products
     * @return Recipe
     */
    public function addProduct(\NFQAkademija\BaseBundle\Entity\RecipeProduct $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param \NFQAkademija\BaseBundle\Entity\RecipeProduct $products
     */
    public function removeProduct(\NFQAkademija\BaseBundle\Entity\RecipeProduct $products)
    {
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
     * Add likes
     *
     * @param \NFQAkademija\BaseBundle\Entity\Like $likes
     * @return Recipe
     */
    public function addLike(\NFQAkademija\BaseBundle\Entity\Like $likes)
    {
        $this->likes[] = $likes;

        return $this;
    }

    /**
     * Remove likes
     *
     * @param \NFQAkademija\BaseBundle\Entity\Like $likes
     */
    public function removeLike(\NFQAkademija\BaseBundle\Entity\Like $likes)
    {
        $this->removeLike($likes);
    }

    /**
     * Get likes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * Add producedRecipes
     *
     * @param \NFQAkademija\BaseBundle\Entity\ProducedRecipe $producedRecipes
     * @return Recipe
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

    /**
     * Add recipeProducts
     *
     * @param \NFQAkademija\BaseBundle\Entity\RecipeProduct $recipeProducts
     * @return Recipe
     */
    public function addRecipeProduct(\NFQAkademija\BaseBundle\Entity\RecipeProduct $recipeProducts)
    {
        $this->recipeProducts[] = $recipeProducts;

        return $this;
    }

    /**
     * Remove recipeProducts
     *
     * @param \NFQAkademija\BaseBundle\Entity\RecipeProduct $recipeProducts
     */
    public function removeRecipeProduct(\NFQAkademija\BaseBundle\Entity\RecipeProduct $recipeProducts)
    {
        $this->removeRecipeProduct($recipeProducts);
    }

    /**
     * Get recipeProducts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRecipeProducts()
    {
        return $this->recipeProducts;
    }
}
