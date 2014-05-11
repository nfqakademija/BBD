<?php

namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminLoginController extends Controller
{
    public function indexAction()
    {
        return $this->render('NFQAkademijaRecipesBundle:AdminLogin:index.html.twig',array());
    }
}
