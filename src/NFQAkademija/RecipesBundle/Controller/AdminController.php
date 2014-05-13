<?php

namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction($type)
    {
        switch($type){
            case "users": return $this->render('NFQAkademijaRecipesBundle:Admin:users.html.twig',array());break;
            case "locations": return $this->render('NFQAkademijaRecipesBundle:Admin:locations.html.twig',array());break;
            case "facts": return $this->render('NFQAkademijaRecipesBundle:Admin:facts.html.twig',array());break;
            case "recipes": return $this->render('NFQAkademijaRecipesBundle:Admin:recipes.html.twig',array());break;
            case "filters": return $this->render('NFQAkademijaRecipesBundle:Admin:filters.html.twig',array());break;
            case "ingredients": return $this->render('NFQAkademijaRecipesBundle:Admin:ingredients.html.twig',array());break;
            case "comments": return $this->render('NFQAkademijaRecipesBundle:Admin:comments.html.twig',array());break;
            case "options": return $this->render('NFQAkademijaRecipesBundle:Admin:options.html.twig',array());break;
            default: return $this->render('NFQAkademijaRecipesBundle:Admin:users.html.twig',array());break;
        }
    }

    public function loginAction(){
        return $this->render('NFQAkademijaRecipesBundle:Admin:login.html.twig',array());
    }
}
