<?php

namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction($type){
        return $this->render('NFQAkademijaRecipesBundle:Admin:'.$type.'.html.twig',array());
    }

    public function loginAction(){
        return $this->render('NFQAkademijaRecipesBundle:Admin:login.html.twig',array());
    }
}
