<?php

namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CookController extends Controller
{
    public function indexAction($recipe_ID)
    {
        return $this->render('NFQAkademijaRecipesBundle:Cook:index.html.twig', array("recipe_ID" => $recipe_ID));
    }

}
