<?php

namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use NFQAkademija\BaseBundle\Entity\ProducedRecipe;

class CookController extends Controller
{
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        //get user id
        $user_ID = 4;
        $user = $em->getRepository('NFQAkademijaBaseBundle:User')->find($user_ID);

        $cook_status = $em->getRepository("NFQAkademijaBaseBundle:ProducedRecipe")->find(array("user" => $user_ID, "recipe" => $id));
        if(!$cook_status){
            //add to user that he has cooked this recipe
            $data = new ProducedRecipe();
            $user = $em->getRepository("NFQAkademijaBaseBundle:User")->find($user_ID);
            $recipe = $em->getRepository("NFQAkademijaBaseBundle:Recipe")->find($id);
            $data->setUser($user);
            $data->setRecipe($recipe);
            $em->persist($data);
            $em->flush();
        }


        //info apie recipe
        //title, steps_amount, like_status, id, like_amount, author, cooking_time, country, main_cooking_method,
        //type, properties, celebration, ingredients(imageUrl, title, amount, unit), imageUrl,
        //about, comments(imageUrl, text), steps(id, info), similar_recipes(id, imageUrl, title)


        $em = $this->getDoctrine()->getManager();
        $recipe = $em->getRepository('NFQAkademijaBaseBundle:Recipe')->find($id);

        $title = $recipe->getName();
        $about = $recipe->getDescription();
        $imageUrl = $recipe->getPhoto();

        $cooking_time = $recipe->getCookingTime();
        if($cooking_time){
            $cooking_time = $cooking_time->getName();
        }else{
            $cooking_time = "";
        }

        $author = $recipe->getUser();
        if($author){
            $author = $author->getName();
        }else{
            $author = "Foodex";
        }

        $celebration = $recipe->getCelebration();
        if($celebration){
            $celebration = $celebration->getName();
        }else{
            $celebration = "";
        }

        $country = $recipe->getCountry();
        if($country){
            $country = $country->getName();
        }else{
            $country = "";
        }

        $main_cooking_method = $recipe->getMainCookingMethod();
        if($main_cooking_method){
            $main_cooking_method = $main_cooking_method->getName();
        }else{
            $main_cooking_method = "";
        }

        $type = $recipe->getType();
        if($type){
            $type = $type->getName();
        }else{
            $type = "";
        }


        $steps_data = $em->getRepository("NFQAkademijaBaseBundle:Step")->findBy(array('recipe' => $id));
        $steps = [];
        foreach($steps_data as $step){
            $steps [] = ["id" => $step->getId(), "info" => $step->getDescription()];
        }
        $steps_amount = count($steps);

        $like_amount = $recipe->getLikes();
        if($like_amount){
            $like_amount = count($like_amount);
        }else{
            $like_amount = 0;
        }

        $like_status = $em->getRepository("NFQAkademijaBaseBundle:Like")->findBy(array('user' => $user, 'recipe' => $id));
        if($like_status){
            $like_status = "liked";
            $like_word = "Patinka";
        }else{
            $like_status = "not_liked";
            $like_word = "Patiko?";
        }

        $properties_data = $recipe->getProperties();
        $properties = "";
        foreach($properties_data as $property){
            $properties .= $property->getName().", ";
        }
        $properties = substr($properties, 0, strlen($properties) - 2);


        $ingredients_data = $em->getRepository("NFQAkademijaBaseBundle:RecipeProduct")->findBy(array('recipe' => $id));
        $ingredients = [];
        foreach($ingredients_data as $ingredient){
            $ingredients [] = [
                $product = $ingredient->getProduct(),
                "imageUrl" => $product->getPhoto(),
                "title" => $product->getName(),
                "amount" => $ingredient->getQuantity(),
                "unit" => $product->getUnit()->getName(),
            ];
        }

        $comments_data = $em->getRepository("NFQAkademijaBaseBundle:Comment")->findBy(array('recipe' => $id));
        $comments = [];
        foreach($comments_data as $comment){
            $comments [] = [
                $user = $comment->getUser(),
                "imageUrl" => $user->getPhoto(),
                "text" => $comment->getText(),
            ];
        }


        $similar_recipes_data = $em->getRepository("NFQAkademijaBaseBundle:Recipe")->findAll();
        $similar_recipes = [];
        foreach($similar_recipes_data as $similar_recipe){
            $similar_recipes [] = [
                "id" => $similar_recipe->getId(),
                "imageUrl" => $similar_recipe->getPhoto(),
                "title" => $similar_recipe->getName(),
            ];
        }


        return $this->render('NFQAkademijaRecipesBundle:Cook:index.html.twig',
            array(
                "id" => $id,
                "title" => $title,
                "about" => $about,
                "steps_amount" => $steps_amount,
                "like_status" => $like_status,
                "like_amount" => $like_amount,
                "cooking_time" => $cooking_time,
                "author" => $author,
                "country" => $country,
                "main_cooking_method" => $main_cooking_method,
                "type" => $type,
                "properties" => $properties,
                "celebration" => $celebration,
                "imageUrl" => $imageUrl,
                "ingredients" => $ingredients,
                "comments" => $comments,
                "steps" => $steps,
                "similar_recipes" => $similar_recipes,
                "like_word" => $like_word,
            ));
    }
}
