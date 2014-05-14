<?php

namespace NFQAkademija\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Time
 *
 * @ORM\Table(name="times")
 * @ORM\Entity
 */
class Time
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
     * @ORM\Column(name="icon", type="string", length=255)
     */
    private $icon;

    /**
     * @var string
     *
     * @ORM\Column(name="time", type="integer")
     */
    private $time;
    /**
     * @ORM\OneToMany(targetEntity="\NFQAkademija\BaseBundle\Entity\Recipe", mappedBy="name")
     */
    protected $recipes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->recipes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Get time
     *
     * @return integer
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Time
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set time
     *
     * @param string $name
     * @return Time
     */
    public function setTime($time)
    {
        $this->time = $time;

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
     * Set icon
     *
     * @param string $icon
     * @return Time
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
     * @return Time
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
