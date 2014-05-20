<?php

namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CookController extends Controller
{
    public function indexAction($id)
    {
        //info apie recipe
        //title, steps_amount, like_status, id, like_amount, author, cooking_time, country, main_cooking_method,
        //type, properties, celebration, ingredients(imageUrl, title, amount, unit), imageUrl,
        //about, comments(imageUrl, text), steps(id, info), similar_recipes(id, imageUrl, title)


        $em = $this->getDoctrine()->getManager();
        $recipe = $em->getRepository('NFQAkademijaBaseBundle:Recipe')->find($id);

        $title = $recipe->getName();
        $about = $recipe->getDescription();
        $cooking_time = $recipe->getCookingTime()->getName();
        $author = $recipe->getUser();
        if($author){
            $author = $author->getName();
        }else{
            $author = "Foodex";
        }

        $celebration = $recipe->getCelebration()->getName();
        $imageUrl = $recipe->getPhoto();
        $country = $recipe->getCountry()->getName();
        $main_cooking_method = $recipe->getMainCookingMethod()->getName();
        $type = $recipe->getTypes();

        //$repository = $this->getDoctrine()->getRepository('NFQAkademijaBaseBundle:'.$zone);
        /*
        $repository = $em->getRepository('NFQAkademijaBaseBundle:Step');
        $query = $repository->createQueryBuilder('f')
            ->select('f.id, f.description')
            ->where('f.recipe = :id')
            ->setParameter('id', $id)
            ->getQuery();
        $steps = $query->getResult();
        */

        $steps = $em->getRepository("NFQAkademijaBaseBundle:Step")->findBy(array('recipe' => $id));
        $steps_amount = count($steps);



        $like_status;
        $like_amount;



        $properties;


        $ingredients_data = $recipe->getProducts();
        $ingredients;
        $comments;
        $similar_recipes;


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
            ));
    }
}
