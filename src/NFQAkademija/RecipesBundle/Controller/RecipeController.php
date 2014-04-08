<?php

namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RecipeController extends Controller
{
    public function indexAction($recipe_ID)
    {
        return $this->render('NFQAkademijaRecipesBundle:Recipe:index.html.twig', array("recipe_ID" => $recipe_ID));
    }
}
