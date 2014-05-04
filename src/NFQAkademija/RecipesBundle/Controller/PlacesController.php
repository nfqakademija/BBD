<?php

namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlacesController extends Controller
{
    public function indexAction()
    {
        return $this->render('NFQAkademijaRecipesBundle:Places:index.html.twig', array());
    }
}
