<?php

namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShoppingListController extends Controller
{
    public function indexAction()
    {
        return $this->render('NFQAkademijaRecipesBundle:ShoppingList:index.html.twig', array());
    }
}
