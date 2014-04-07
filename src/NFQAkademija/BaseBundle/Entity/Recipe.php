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
     * @ORM\Column(name="photo", type="string", length=255)
     */
    private $photo;

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
     * @ORM\OneToMany(targetEntity="\NFQAkademija\BaseBundle\Entity\Product")
     */
    protected $products;

    /**
     * @ORM\OneToMany(targetEntity="\NFQAkademija\BaseBundle\Entity\Property")
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

}
