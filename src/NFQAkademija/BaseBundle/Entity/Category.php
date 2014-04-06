<?php

namespace NFQAkademija\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table()
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
     * @var integer
     *
     * @ORM\Column(name="CategoryId", type="integer")
     */
    private $categoryId;

    /**
     * @var string
     *
     * @ORM\Column(name="CatName", type="string", length=255)
     */
    private $catName;

    /**
     * @var string
     *
     * @ORM\Column(name="CatPhoto", type="string", length=255)
     */
    private $catPhoto;


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
     * Set categoryId
     *
     * @param integer $categoryId
     * @return Category
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer 
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set catName
     *
     * @param string $catName
     * @return Category
     */
    public function setCatName($catName)
    {
        $this->catName = $catName;

        return $this;
    }

    /**
     * Get catName
     *
     * @return string 
     */
    public function getCatName()
    {
        return $this->catName;
    }

    /**
     * Set catPhoto
     *
     * @param string $catPhoto
     * @return Category
     */
    public function setCatPhoto($catPhoto)
    {
        $this->catPhoto = $catPhoto;

        return $this;
    }

    /**
     * Get catPhoto
     *
     * @return string 
     */
    public function getCatPhoto()
    {
        return $this->catPhoto;
    }
}
