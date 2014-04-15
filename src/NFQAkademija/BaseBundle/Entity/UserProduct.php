<?php

namespace NFQAkademija\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserProduct
 *
 * @ORM\Table(name="user_products")
 * @ORM\Entity
 */
class UserProduct
{
    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="\NFQAkademija\BaseBundle\Entity\Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false)
     */
    protected $product;

    /**
     * @var integer
     */
    protected $quantity;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="\NFQAkademija\BaseBundle\Entity\UserFridge")
     * @ORM\JoinColumn(name="user_fridge_id", referencedColumnName="id", nullable=false)
     */
    protected $userFridge;


    /**
     * Set product
     *
     * @param \NFQAkademija\BaseBundle\Entity\Product $product
     * @return UserProduct
     */
    public function setProduct(\NFQAkademija\BaseBundle\Entity\Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \NFQAkademija\BaseBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set userFridge
     *
     * @param \NFQAkademija\BaseBundle\Entity\UserFridge $userFridge
     * @return UserProduct
     */
    public function setUserFridge(\NFQAkademija\BaseBundle\Entity\UserFridge $userFridge)
    {
        $this->userFridge = $userFridge;

        return $this;
    }

    /**
     * Get userFridge
     *
     * @return \NFQAkademija\BaseBundle\Entity\UserFridge 
     */
    public function getUserFridge()
    {
        return $this->userFridge;
    }
}
