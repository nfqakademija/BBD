<?php

namespace NFQAkademija\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserFridge
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class UserFridge
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
     * @var \NFQAkademija\BaseBundle\Entity\User
     * @ORM\OneToMany(targetEntity="\NFQAkademija\BaseBundle\Entity\User", mappedBy="userFrige")
     */
    protected $users;

    /**
     * @ORM\OneToMany(targetEntity="\NFQAkademija\BaseBundle\Entity\UserProduct", mappedBy="userFridge")
     */
    protected $products;


}
