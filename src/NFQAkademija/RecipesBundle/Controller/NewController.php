<?php

namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewController extends Controller
{
    public function indexAction()
    {
        return $this->render('NFQAkademijaRecipesBundle:New:index.html.twig', array());
    }
}
