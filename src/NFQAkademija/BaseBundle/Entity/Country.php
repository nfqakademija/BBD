<?php

namespace NFQAkademija\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 *
 * @ORM\Table(name="countries")
 * @ORM\Entity
 */
class Country
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
     * @ORM\Column(name="Name", type="string", length=255)
     */
    private $Name;

    /**
     * @var string
     *
     * @ORM\Column(name="Flag", type="string", length=255)
     */
    private $Flag;
    /**
     * @ORM\OneToMany(targetEntity="\NFQAkademija\BaseBundle\Entity\Recipe", mappedBy="country")
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
        return $this->getName();
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
     * Set Name
     *
     * @param string $name
     * @return Country
     */
    public function setName($name)
    {
        $this->Name = $name;

        return $this;
    }

    /**
     * Get Name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * Set Flag
     *
     * @param string $flag
     * @return Country
     */
    public function setFlag($flag)
    {
        $this->Flag = $flag;

        return $this;
    }

    /**
     * Get Flag
     *
     * @return string 
     */
    public function getFlag()
    {
        return $this->Flag;
    }

    /**
     * Add recipes
     *
     * @param \NFQAkademija\BaseBundle\Entity\Recipe $recipes
     * @return Country
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
