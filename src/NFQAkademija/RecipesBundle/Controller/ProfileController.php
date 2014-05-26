<?php

namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Facebook\FacebookJavaScriptLoginHelper;
use Facebook\FacebookSession;

class ProfileController extends Controller
{
    public function indexAction()
    {



        $em = $this->getDoctrine()->getManager();
        $user_ID = 4;
        $user = $em->getRepository("NFQAkademijaBaseBundle:User")->find($user_ID);

        $profile_name = $user->getName();
        $profile_imageUrl = "/images/profile.png";//$user->getPhoto();
        $profile_coverUrl = "/images/food (16).jpg";//$user->getCoverPhoto();

        $likes = $em->getRepository("NFQAkademijaBaseBundle:Like")->findBy(array("user" => $user_ID));
        if($likes){
            $likes = count($likes);
        }else{
            $likes = 0;
        }

        $cooks = $em->getRepository("NFQAkademijaBaseBundle:ProducedRecipe")->findBy(array("user" => $user_ID));
        if($cooks){
            $cooks = count($likes);
        }else{
            $cooks = 0;
        }

        $created = $em->getRepository("NFQAkademijaBaseBundle:Recipe")->findBy(array("user" => $user_ID));
        if($created){
            $created = count($created);
        }else{
            $created = 0;
        }

        return $this->render('NFQAkademijaRecipesBundle:Profile:index.html.twig',
            array(
                "profile_name" => $profile_name,
                "profile_imageUrl" => $profile_imageUrl,
                "profile_coverUrl" => $profile_coverUrl,
                "amount_cooked" => $cooks,
                "amount_liked" => $likes,
                "amount_created" => $created,
            ));
    }
}
