<?php

namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RandomController extends Controller
{
    public function indexAction()
    {
        return $this->render('NFQAkademijaRecipesBundle:Random:index.html.twig', array());
    }
}
