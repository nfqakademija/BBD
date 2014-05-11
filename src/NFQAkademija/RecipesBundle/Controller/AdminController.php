<?php

namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction($type)
    {
        switch($type){
            case "users": $title = "Vartotojai"; break;
            case "locations": $title = "Vietos"; break;
            case "facts": $title = "Faktai"; break;
            case "recipes": $title = "Receptai"; break;
            case "filters": $title = "Filtrai"; break;
            case "ingredients": $title = "Ingredientai"; break;
            case "comments": $title = "Komentarai"; break;
            case "options": $title = "Nustatymai"; break;
            default: $title = "Vartotojai"; break;
        }

        /*
        type:
        Users:
        Recipes:
        Locations:
        Facts:
        Options:
        Filters:
        Ingredients:
        Comments:
         */

        $admin_content = $type;

        return $this->render('NFQAkademijaRecipesBundle:Admin:index.html.twig',array("admin_content" => $admin_content, "title" => $title));
    }
}
