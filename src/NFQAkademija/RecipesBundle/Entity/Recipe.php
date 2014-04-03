<?php

namespace NFQAkademija\RecipesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recipe
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="NFQAkademija\RecipesBundle\Entity\RecipeRepository")
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
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="recipe_name", type="string", length=255)
     */
    protected $recipeName;

    /**
     * @var string
     *
     * @ORM\Column(name="recipe_type", type="string", length=255)
     */
    protected $recipeType;

    /**
     * @var string
     *
     * @ORM\Column(name="recipe_ingredients", type="string", length=255)
     */
    protected $recipeIngredients;


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
     * Set recipeType
     *
     * @param string $recipeType
     * @return Recipe
     */
    public function setRecipeType($recipeType)
    {
        $this->recipeType = $recipeType;

        return $this;
    }

    /**
     * Get recipeType
     *
     * @return string 
     */
    public function getRecipeType()
    {
        return $this->recipeType;
    }

    /**
     * Set recipeIngredients
     *
     * @param string $recipeIngredients
     * @return Recipe
     */
    public function setRecipeIngredients($recipeIngredients)
    {
        $this->recipeIngredients = $recipeIngredients;

        return $this;
    }

    /**
     * Get recipeIngredients
     *
     * @return string 
     */
    public function getRecipeIngredients()
    {
        return $this->recipeIngredients;
    }
}
