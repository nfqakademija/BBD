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
    private $shoppingLists;
    /**
     * @var integer
     *
     * @ORM\Id()
     * @ORM\Column(name="ProductId", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Photo", type="string", length=255)
     */
    private $photo;
    /**
     * @ORM\ManyToOne(targetEntity="\NFQAkademija\BaseBundle\Entity\category", mappedBy="products")
     */
    private $category;
}
