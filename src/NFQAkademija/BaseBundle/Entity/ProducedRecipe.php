<?php

namespace NFQAkademija\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProducedRecipe
 *
 * @ORM\Table(name="produced_recipes")
 * @ORM\Entity
 */
class ProducedRecipe
{
    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="\NFQAkademija\BaseBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $user;
    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="\NFQAkademija\BaseBundle\Entity\Recipe")
     * @ORM\JoinColumn(name="recipe_id", referencedColumnName="id", nullable=false)
     */
    protected $recipe;

    /**
     * Set user
     *
     * @param \NFQAkademija\BaseBundle\Entity\User $user
     * @return ProducedRecipe
     */
    public function setUser(\NFQAkademija\BaseBundle\Entity\User $user)
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
     * Set recipe
     *
     * @param \NFQAkademija\BaseBundle\Entity\Recipe $recipe
     * @return ProducedRecipe
     */
    public function setRecipe(\NFQAkademija\BaseBundle\Entity\Recipe $recipe)
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
