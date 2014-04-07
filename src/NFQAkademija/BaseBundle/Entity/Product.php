<?php

namespace NFQAkademija\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="products")
 * @ORM\Entity
 */
class Product
{

    private $properties;

    private $shoppingLists;

    /**
     * @var integer
     *
     * @ORM\Id()
     * @ORM\Column(name="ProductId", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    private $recipes;

    /**
     * @var string
     *
     * @ORM\Column(name="ProductName", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="ProductPhoto", type="string", length=255)
     */
    private $photo;

}
