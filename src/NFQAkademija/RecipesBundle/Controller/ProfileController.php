<?php

namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfileController extends Controller
{
    public function indexAction()
    {
        $profile_name = "Ignas Lekas";
        $profile_imageUrl = "/images/profile.png";
        $amount_cooked = "5";
        $amount_liked = "8";
        $amount_created = "2";
        return $this->render('NFQAkademijaRecipesBundle:Profile:index.html.twig',
            array(
                "profile_name" => $profile_name,
                "profile_imageUrl" => $profile_imageUrl,
                "amount_cooked" => $amount_cooked,
                "amount_liked" => $amount_liked,
                "amount_created" => $amount_created,
            ));
    }
}
