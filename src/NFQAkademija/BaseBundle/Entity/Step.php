<?php

namespace NFQAkademija\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Step
 *
 * @ORM\Table(name="steps")
 * @ORM\Entity
 */
class Step
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
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;
    /**
     * @ORM\ManyToOne(targetEntity="\NFQAkademija\BaseBundle\Entity\Recipe")
     */
    private $recipe;

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
     * Set description
     *
     * @param string $description
     * @return Step
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
     * Set recipe
     *
     * @param \NFQAkademija\BaseBundle\Entity\Recipe $recipe
     * @return Step
     */
    public function setRecipe(\NFQAkademija\BaseBundle\Entity\Recipe $recipe = null)
    {
        $this->recipe = $recipe;

        return $this;
    }

    /**
     * Get recipe
     *
     * @return \NFQAkademija\BaseBundle\Entity\Recipe 
     */
    public function getRecipe()
    {
        return $this->recipe;
    }
}
