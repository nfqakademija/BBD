<?php

namespace NFQAkademija\RecipesBundle\Controller;

use Doctrine\ORM\EntityManager;
use NFQAkademija\BaseBundle\Entity\ProducedRecipe;
use NFQAkademija\BaseBundle\Entity\Recipe;
use NFQAkademija\BaseBundle\Entity\Shoppinglist;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use NFQAkademija\BaseBundle\Entity\Fact;
use NFQAkademija\BaseBundle\Entity\Like;
use NFQAkademija\BaseBundle\Entity\Comment;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Session\Session;



class AjaxLoadController extends Controller
{
    public function load_profile_recipesAction(Request $request)
    {
        $request_data = $request->request;
        $type = $request_data->get('type');
        $reset = $request_data->get('reset');
        $session = $request->getSession();
        $end = false;
        $em = $this->getDoctrine()->getManager();
        //get user ID
        $user_ID = 4;

        $limit = 20;
        $offset = 0;
        if($session->has('load_recipes_offset')){
            $offset = $session->get('load_recipes_offset');
        }else{
            $session->set('load_recipes_offset', $offset);
        }

        if($reset == "true"){
            //reset limit to 0 - LIMIT 10, 0;
            $offset = 0;
            $session->set('load_recipes_offset', $offset);
        }

        //types: created, cooked, liked
        $recipe_ids = [];
        switch($type){
            case "liked":
                $liked_recipes = $em->getRepository("NFQAkademijaBaseBundle:Like")->findBy(array("user" => $user_ID));
                foreach ($liked_recipes as $liked_recipe) {
                    $recipe_ids[] = $liked_recipe->getRecipe()->getId();
                }
                break;
            case "cooked":
                $cooked_recipes = $em->getRepository("NFQAkademijaBaseBundle:ProducedRecipe")->findBy(array("user" => $user_ID));
                foreach ($cooked_recipes as $cooked_recipe) {
                    $recipe_ids[] = $cooked_recipe->getRecipe()->getId();
                }
                break;
            case "created":
                $created_recipes = $em->getRepository("NFQAkademijaBaseBundle:Recipe")->findBy(array("user" => $user_ID));
                foreach ($created_recipes as $created_recipe) {
                    $recipe_ids[] = $created_recipe->getId();
                }
                break;
        }

        $recipes = [];
        $recipe_repository = $this->getDoctrine()->getRepository('NFQAkademijaBaseBundle:Recipe');
        $query = $recipe_repository->createQueryBuilder('f');
        $query = $query->select('f.id, f.name, f.photo')
            ->orderBy('f.name', 'ASC')
            ->where('f.id IN (:recipe_ids)')
            ->setParameter('recipe_ids', $recipe_ids)
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery();

        $recipes = $query->getResult();
        $recipes_loaded = count($recipes);
        //jei rado receptu
        if($recipes_loaded != 0 ){
            if($recipes_loaded < $limit){
                //jei receptu rado ne pilnai = reiskia daugiau receptu nebebus todel offset nedidint
                $end = true;
            }else{
                //receptu rado tiek koks yra limitas. Reiskias gali buti ir daugaiu pagal sia uzklausa. Offset didint
                $session->set('load_recipes_offset', $offset + $limit);
            }
        }

        $response = array(
            'status' => 'good',
            'recipes' => $recipes,
            'end' => $end,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function load_recipesAction(Request $request)
    {
        $request_data = $request->request;
        $session = $request->getSession();
        $reset = $request_data->get('reset');
        $end = false;

        $limit = 20;
        $offset = 0;
        if($session->has('load_recipes_offset')){
            $offset = $session->get('load_recipes_offset');
        }else{
            $session->set('load_recipes_offset', $offset);
        }

        if($reset == "true"){
            //reset limit to 0 - LIMIT 10, 0;
            $offset = 0;
            $session->set('load_recipes_offset', $offset);
        }

        $recipes = [];
        $recipe_repository = $this->getDoctrine()->getRepository('NFQAkademijaBaseBundle:Recipe');

        //QUERYING AND FILTERING
        $filters = [];
        if($session->has('filters')){
            $filters = $session->get('filters');
        }

        $filtering = [];
        $filtering["Type_want"] = [];
        $filtering["Type_not_want"] = [];
        $filtering["Property_want"] = [];
        $filtering["Property_not_want"] = [];
        $filtering["CookingTime_want"] = [];
        $filtering["CookingTime_not_want"] = [];
        $filtering["Country_want"] = [];
        $filtering["Country_not_want"] = [];
        $filtering["Product_want"] = [];
        $filtering["Product_not_want"] = [];
        $filtering["Celebration_want"] = [];
        $filtering["Celebration_not_want"] = [];
        $filtering["Main_cooking_method_want"] = [];
        $filtering["Main_cooking_method_not_want"] = [];

        foreach($filters as $filter){
            $filter_type = $filter["type"];
            $filter_indicator = $filter["indicator"];
            $filter_tag = $filter_type."_".$filter_indicator;
            $filtering[$filter_tag][] = $filter["id"];
        }

        //filter types: type, property, time, country, ingredients, celebration, main_cooking_method
        $query = $recipe_repository->createQueryBuilder('f');
        $query->select('f.id, f.name, f.photo')
            ->leftJoin('f.products', 'p')
            ->leftJoin('f.properties', 's')
            ->distinct()
            ->orderBy('f.name', 'ASC');

        //type
        if(count($filtering["Type_want"]) > 0)
            $query = $query->andWhere("f.type IN (:filters_for_type_want)")->setParameter('filters_for_type_want', $filtering["Type_want"]);
        if(count($filtering["Type_not_want"]) > 0)
            $query = $query->andWhere("f.type NOT IN (:filters_for_type_not_want)")->setParameter('filters_for_type_not_want', $filtering["Type_not_want"]);

        //country
        if(count($filtering["Country_want"]) > 0)
            $query = $query->andWhere("f.country IN (:filters_for_country_want)")->setParameter('filters_for_country_want', $filtering["Country_want"]);
        if(count($filtering["Country_not_want"]) > 0)
            $query = $query->andWhere("f.country NOT IN (:filters_for_country_not_want)")->setParameter('filters_for_country_not_want', $filtering["Country_not_want"]);

        //celebration
        if(count($filtering["Celebration_want"]) > 0)
            $query = $query->andWhere("f.celebration IN (:filters_for_celebration_want)")->setParameter('filters_for_celebration_want', $filtering["Celebration_want"]);
        if(count($filtering["Celebration_not_want"]) > 0)
            $query = $query->andWhere("f.celebration NOT IN (:filters_for_celebration_not_want)")->setParameter('filters_for_celebration_not_want', $filtering["Celebration_not_want"]);

        //main_cooking_method
        if(count($filtering["Main_cooking_method_want"]) > 0)
            $query = $query->andWhere("f.mainCookingMethod IN (:filters_for_main_cooking_method_want)")->setParameter('filters_for_main_cooking_method_want', $filtering["Main_cooking_method_want"]);
        if(count($filtering["Main_cooking_method_not_want"]) > 0)
            $query = $query->andWhere("f.mainCookingMethod NOT IN (:filters_for_main_cooking_method_not_want)")->setParameter('filters_for_main_cooking_method_not_want', $filtering["Main_cooking_method_not_want"]);


        //ingredients
        //gaunasi kad arba tas ingredientas arba tas gali buti
        if(count($filtering["Product_want"]) > 0){
            $query = $query->andWhere("p.product IN (:filters_for_ingredients_want)")->setParameter('filters_for_ingredients_want', $filtering["Product_want"]);
        }

        if(count($filtering["Product_not_want"]) > 0){
            $query = $query->andWhere("p.product NOT IN (:filters_for_ingredients_not_want)")->setParameter('filters_for_ingredients_not_want', $filtering["Product_not_want"]);
        }

        //time
        //reik pridet kad rodytu IKI to pasirinkto laiko, ta laika ir mazesnius
        if(count($filtering["CookingTime_want"]) > 0)
            $query = $query->andWhere("f.cookingTime IN (:filters_for_time_want)")->setParameter('filters_for_time_want', $filtering["CookingTime_want"]);
        if(count($filtering["CookingTime_not_want"]) > 0)
            $query = $query->andWhere("f.cookingTime NOT IN (:filters_for_time_not_want)")->setParameter('filters_for_time_not_want', $filtering["CookingTime_not_want"]);

        //properties
        //gaunasi kad arba tas property arba tas gali buti
        if(count($filtering["Property_want"]) > 0){
            $query = $query->andWhere("s.id IN (:filters_for_property_want)")->setParameter('filters_for_property_want', $filtering["Property_want"]);
        }
        if(count($filtering["Property_not_want"]) > 0){
            $query = $query->andWhere("s.id NOT IN (:filters_for_property_not_want)")->setParameter('filters_for_property_not_want', $filtering["Property_not_want"]);
        }
        $query = $query->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery();


        $recipes = $query->getResult();

        $recipes_loaded = count($recipes);
        //jei rado receptu
        if($recipes_loaded != 0 ){
            if($recipes_loaded < $limit){
                //jei receptu rado ne pilnai = reiskia daugiau receptu nebebus todel offset nedidint
                $end = true;
            }else{
                //receptu rado tiek koks yra limitas. Reiskias gali buti ir daugaiu pagal sia uzklausa. Offset didint
                $session->set('load_recipes_offset', $offset + $limit);
            }
        }

        $response = array(
            'status' => 'good',
            'recipes' => $recipes,
            'end' => $end,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function load_productsAction(Request $request)
    {
        $request_data = $request->request;
        $session = $request->getSession();
        $reset = $request_data->get('reset');
        $end = false;

        $limit = 20;
        $offset = 0;
        if($session->has('load_products_offset')){
            $offset = $session->get('load_products_offset');
        }else{
            $session->set('load_products_offset', $offset);
        }

        if($reset == "true"){
            $offset = 0;
            $session->set('load_products_offset', $offset);
        }

        $em = $this->getDoctrine()->getManager();
        $user_ID = 4;
        $data = $em->getRepository("NFQAkademijaBaseBundle:Shoppinglist")->findBy(array("user" => $user_ID));
        $already_in_shoppinglist_ids = [];
        foreach ($data as $dat){
            $product = $dat->getProduct();
            $id = $product->getId();
            $already_in_shoppinglist_ids[] = $id;
        }

        $product_repository = $this->getDoctrine()->getRepository('NFQAkademijaBaseBundle:Product');
        $query = $product_repository->createQueryBuilder('f');
        $query = $query->select('f.id, f.name AS title, f.photo AS imageUrl')
            ->orderBy('f.name', 'ASC')
            ->Where('f.id NOT IN (:already_in_shoppinglist_ids)')
            ->setParameter('already_in_shoppinglist_ids', $already_in_shoppinglist_ids)
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery();
        $products = $query->getResult();

        $products_loaded = count($products);
        //jei rado produktu
        if($products_loaded != 0 ){
            if($products_loaded < $limit){
                //jei produktu rado ne pilnai = reiskia daugiau produktu nebebus todel offset nedidint
                $end = true;
            }else{
                //produktu rado tiek koks yra limitas. Reiskias gali buti ir daugaiu pagal sia uzklausa. Offset didint
                $session->set('load_products_offset', $offset + $limit);
            }
        }

        $response = array(
            'status' => 'good',
            'products' => $products,
            'end' => $end,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function loading_screenAction(Request $request)
    {
        $request_data = $request->request;
        $status = $request_data->get('status');
        $session = $request->getSession();
        $fact = "";

        //hide_loading_screen sunaikina sesija
        //tada kita karta iskvietus show_loading_screen susikurs sesija su random faktu ir jy rodys kol
        //uzkraus psulapy ir kai uzkraus kol iskvies hide_loading_screen

        if($status == "start"){
            //create session with random fact
            $repository = $this->getDoctrine()->getRepository('NFQAkademijaBaseBundle:Fact');
            $query = $repository->createQueryBuilder('f')
                ->select('f.text')
                ->getQuery();

            $all_data = $query->getResult();
            $random_id = mt_rand(0, count($all_data) - 1);
            $fact = $all_data[$random_id]["text"];
            $session->set('fact', $fact);
        }else{
            //delete session
            $session->remove('fact');
        }

        $response = array(
            'status' => 'good',
            'fact' => $fact,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function load_recipe_in_sidebarAction(Request $request)
    {
        $request_data = $request->request;
        $recipe_ID = $request_data->get('recipe_ID');
        $em = $this->getDoctrine()->getManager();
        $recipe = $em->getRepository('NFQAkademijaBaseBundle:Recipe')->find($recipe_ID);
        $user_ID = '4';

        if($recipe) {
            $title = $recipe->getName();
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

            $like_amount = $recipe->getLikes();
            if($like_amount){
                $like_amount = count($like_amount);
            }else{
                $like_amount = 0;
            }

            $like_status = $em->getRepository("NFQAkademijaBaseBundle:Like")->find(array("user" => $user_ID, "recipe" => $recipe_ID));
            if($like_status){
                $like_status = "liked";
            }else{
                $like_status = "not_liked";
            }

            $properties_data = $recipe->getProperties();
            $properties = "";
            if($properties_data){
                foreach($properties_data as $property){
                    $properties .= $property->getName().", ";
                }
                $properties = substr($properties, 0, strlen($properties) - 2);
            }

            $ingredients_data = $em->getRepository("NFQAkademijaBaseBundle:RecipeProduct")->findBy(array('recipe' => $recipe_ID));
            $ingredients = "";
            foreach($ingredients_data as $ingredient){
                $product = $ingredient->getProduct();
                $indicator = "";
                $single_ingredient = $this->render('NFQAkademijaRecipesBundle:AjaxViews:Ingredient.html.twig',
                    array(
                        'id' => "Product-".$product->getId(),
                        'title' => $product->getName(),
                        'imageUrl' => $product->getPhoto(),
                        'quantity' => $ingredient->getQuantity(),
                        'unit' => $product->getUnit()->getName(),
                        'indicator' => $indicator,
                    ));
                $single_ingredient = $single_ingredient->getContent();

                $ingredients .= $single_ingredient;
            }


            $recipe_data = $this->render('NFQAkademijaRecipesBundle:AjaxViews:RecipeRightSidebar.html.twig',
                array(
                    'id' => $recipe_ID,
                    'title' => $title,
                    'imageUrl' => $imageUrl,
                    'like_status' => $like_status,
                    'like_amount' => $like_amount,
                    'author' => $author,
                    'cooking_time' => $cooking_time,
                    'country' => $country,
                    'type' => $type,
                    'main_cooking_method' => $main_cooking_method,
                    'properties' => $properties,
                    'celebration' => $celebration,
                    'ingredients' => $ingredients,
                ));
            $recipe_data = $recipe_data->getContent();
            $status = "good";
        }else{
            $recipe_data = "";
            $status = "bad";
        }

        $response = array(
            'status' => $status,
            'recipe_data' => $recipe_data,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }
}