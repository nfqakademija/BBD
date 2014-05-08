<?php

namespace NFQAkademija\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CookingTime
 *
 * @ORM\Table(name="cooking_time")
 * @ORM\Entity
 */
class CookingTime
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
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="time")
     */
    private $time;
    /**
     * @var string
     *
     * @ORM\Column(name="icon", type="string", length=255)
     */
    private $icon;
    /**
     * @ORM\OneToMany(targetEntity="\NFQAkademija\BaseBundle\Entity\Recipe", mappedBy="cookingTime")
     */
    protected $recipes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->recipes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString(){

        $result = $this->getTime()->format("s\:i");
        return $result;
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
     * Set time
     *
     * @param \DateTime $time
     * @return CookingTime
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime 
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set icon
     *
     * @param string $icon
     * @return CookingTime
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string 
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Add recipes
     *
     * @param \NFQAkademija\BaseBundle\Entity\Recipe $recipes
     * @return CookingTime
     */
    public function addRecipe(\NFQAkademija\BaseBundle\Entity\Recipe $recipes)
    {
        $this->recipes[] = $recipes;

        return $this;
    }

    /**
     * Remove recipes
     *
     * @param \NFQAkademija\BaseBundle\Entity\Recipe $recipes
     */
    public function removeRecipe(\NFQAkademija\BaseBundle\Entity\Recipe $recipes)
    {
        $this->recipes->removeElement($recipes);
    }

    /**
     * Get recipes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRecipes()
    {
        return $this->recipes;
    }
}
