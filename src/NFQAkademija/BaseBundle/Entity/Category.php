<?php

namespace NFQAkademija\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity
 */
class Category
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
     * @ORM\Column(name="Photo", type="string", length=255)
     */
    private $Photo;
    /**
     * @ORM\OneToMany(targetEntity="\NFQAkademija\BaseBundle\Entity\Product")
     */
    protected $products;
}
