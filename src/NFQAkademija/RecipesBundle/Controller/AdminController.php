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
            case "options": $title = "Nustatymai"; break;
            default: $title = "Vartotojai"; break;
        }

        return $this->render('NFQAkademijaRecipesBundle:Admin:index.html.twig',array("type" => $type, "title" => $title));
    }
}
