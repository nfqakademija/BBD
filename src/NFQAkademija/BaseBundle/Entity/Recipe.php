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
     * @var float
     *
     * @ORM\Column(name="rating", type="float")
     */
    private $rating;

    /**
     * @var integer
     *
     * @ORM\Column(name="raters", type="integer")
     */
    private $raters;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255)
     */
    private $photo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cooking_duration", type="time")
     */
    private $cookingDuration;

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
        $this->properties->removeElement($properties);
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
}
