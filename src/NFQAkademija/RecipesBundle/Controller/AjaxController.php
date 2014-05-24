<?php

namespace NFQAkademija\RecipesBundle\Controller;

use Doctrine\ORM\EntityManager;
use NFQAkademija\BaseBundle\Entity\ProducedRecipe;
use NFQAkademija\BaseBundle\Entity\Recipe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use NFQAkademija\BaseBundle\Entity\Fact;
use NFQAkademija\BaseBundle\Entity\Like;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Session\Session;



class AjaxController extends Controller
{
    public function new_recipeAction(Request $request)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $request_data = $request->request;
        $request_files = $request->files;

        $title = $request_data->get('new_recipe_title');
        $about = $request_data->get('new_recipe_about');
        $time = $request_data->get('new_recipe_time');
        $country = $request_data->get('new_recipe_country');
        $main_cooking_method = $request_data->get('new_recipe_main_cooking_method');
        $celebration = $request_data->get('new_recipe_celebration');
        $type = $request_data->get('new_recipe_type');

        $propertiesIds = json_decode($request_data->get('new_recipe_properties'));
        $ingredients = json_decode(json_decode($request_data->get('new_recipe_ingredients')));
        $steps = json_decode($request_data->get('new_recipe_steps'));

        $image = $request_files->get('new_recipe_image');

        //insert all data into DB in recipes
        $recipe = new Recipe();
        $recipe->setName($title); //varchar
        $recipe->setCelebration($celebration); //id
        $recipe->setCountry($country); //id
        $recipe->setDescription($about); //varchar
        $recipe->setMainCookingMethod($main_cooking_method); //id
        $recipe->setPhoto('/images/profile.png'); //id
        $recipe->setCookingTime($time); //id
        $recipe->setType($type); //id

        $properties = $em->getRepository("NFQAkademijaBaseBundle:Property")->findBy(array('id' => $propertiesIds));

        foreach ($properties as $property) {
            $recipe->addProperty($property);
        }

        $em->persist($recipe);
        $em->flush();

        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

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
        $property_repository = $this->getDoctrine()->getRepository('NFQAkademijaBaseBundle:Property');


        //QUERYING AND FILTERING
        $filters = [];
        if($session->has('filters')){
            $filters = $session->get('filters');
        }


        $filters_for_type_want = [];
        $filters_for_type_not_want = [];

        $filters_for_property_want = [];
        $filters_for_property_not_want = [];

        $filters_for_time_want = [];
        $filters_for_time_not_want = [];

        $filters_for_country_want = [];
        $filters_for_country_not_want = [];

        $filters_for_ingredients_want = [];
        $filters_for_ingredients_not_want = [];

        $filters_for_celebration_want = [];
        $filters_for_celebration_not_want = [];

        $filters_for_main_cooking_method_want = [];
        $filters_for_main_cooking_method_not_want = [];

        foreach($filters as $filter){
            $filter_type = $filter["type"];
            if($filter_type == "Type" && $filter["indicator"] == "want") {
                $filters_for_type_want [] = $filter["id"];
            }else if($filter_type == "Type" && $filter["indicator"] == "not_want"){
                $filters_for_type_not_want [] = $filter["id"];
            }

            if($filter_type == "Property" && $filter["indicator"] == "want") {
                $filters_for_property_want [] = $filter["id"];
            }else if($filter_type == "Property" && $filter["indicator"] == "not_want"){
                $filters_for_property_not_want [] = $filter["id"];
            }

            if($filter_type == "CookingTime" && $filter["indicator"] == "want") {
                $filters_for_time_want [] = $filter["id"];
            }else if($filter_type == "CookingTime" && $filter["indicator"] == "not_want"){
                $filters_for_time_not_want [] = $filter["id"];
            }

            if($filter_type == "Country" && $filter["indicator"] == "want") {
                $filters_for_country_want [] = $filter["id"];
            }else if($filter_type == "Country" && $filter["indicator"] == "not_want"){
                $filters_for_country_not_want [] = $filter["id"];
            }

            if($filter_type == "Product" && $filter["indicator"] == "want") {
                $filters_for_ingredients_want [] = $filter["id"];
            }else if($filter_type == "Product" && $filter["indicator"] == "not_want"){
                $filters_for_ingredients_not_want [] = $filter["id"];
            }

            if($filter_type == "Celebration" && $filter["indicator"] == "want") {
                $filters_for_celebration_want [] = $filter["id"];
            }else if($filter_type == "Celebration" && $filter["indicator"] == "not_want"){
                $filters_for_celebration_not_want [] = $filter["id"];
            }

            if($filter_type == "MainCookingMethod" && $filter["indicator"] == "want") {
                $filters_for_main_cooking_method_want [] = $filter["id"];
            }else if($filter_type == "MainCookingMethod" && $filter["indicator"] == "not_want"){
                $filters_for_main_cooking_method_not_want [] = $filter["id"];
            }
        }

        //filter types: type, property, time, country, ingredients, celebration, main_cooking_method
        $query = $recipe_repository->createQueryBuilder('f');
        $query->select('f.id, f.name, f.photo')
            ->leftJoin('f.products', 'p')
            ->leftJoin('f.properties', 's')
            ->distinct()
            ->orderBy('f.name', 'ASC');

        //type
        if(count($filters_for_type_want) > 0)
            $query = $query->andWhere("f.type IN (:filters_for_type_want)")->setParameter('filters_for_type_want', $filters_for_type_want);
        if(count($filters_for_type_not_want) > 0)
            $query = $query->andWhere("f.type NOT IN (:filters_for_type_not_want)")->setParameter('filters_for_type_not_want', $filters_for_type_not_want);

        //country
        if(count($filters_for_country_want) > 0)
            $query = $query->andWhere("f.country IN (:filters_for_country_want)")->setParameter('filters_for_country_want', $filters_for_country_want);
        if(count($filters_for_country_not_want) > 0)
            $query = $query->andWhere("f.country NOT IN (:filters_for_country_not_want)")->setParameter('filters_for_country_not_want', $filters_for_country_not_want);

        //celebration
        if(count($filters_for_celebration_want) > 0)
            $query = $query->andWhere("f.celebration IN (:filters_for_celebration_want)")->setParameter('filters_for_celebration_want', $filters_for_celebration_want);
        if(count($filters_for_celebration_not_want) > 0)
            $query = $query->andWhere("f.celebration NOT IN (:filters_for_celebration_not_want)")->setParameter('filters_for_celebration_not_want', $filters_for_celebration_not_want);

        //main_cooking_method
        if(count($filters_for_main_cooking_method_want) > 0)
            $query = $query->andWhere("f.mainCookingMethod IN (:filters_for_main_cooking_method_want)")->setParameter('filters_for_main_cooking_method_want', $filters_for_main_cooking_method_want);
        if(count($filters_for_main_cooking_method_not_want) > 0)
            $query = $query->andWhere("f.mainCookingMethod NOT IN (:filters_for_main_cooking_method_not_want)")->setParameter('filters_for_main_cooking_method_not_want', $filters_for_main_cooking_method_not_want);

        //ingredients
        //gaunasi kad arba tas ingredientas arba tas gali buti
        if(count($filters_for_ingredients_want) > 0){
            $query = $query->andWhere("p.product IN (:filters_for_ingredients_want)")->setParameter('filters_for_ingredients_want', $filters_for_ingredients_want);
        }

        if(count($filters_for_ingredients_not_want) > 0){
            $query = $query->andWhere("p.product NOT IN (:filters_for_ingredients_not_want)")->setParameter('filters_for_ingredients_not_want', $filters_for_ingredients_not_want);
        }

        //time
        //reik pridet kad rodytu IKI to pasirinkto laiko, ta laika ir mazesnius
        if(count($filters_for_time_want) > 0)
            $query = $query->andWhere("f.cookingTime IN (:filters_for_time_want)")->setParameter('filters_for_time_want', $filters_for_time_want);
        if(count($filters_for_time_not_want) > 0)
            $query = $query->andWhere("f.cookingTime NOT IN (:filters_for_time_not_want)")->setParameter('filters_for_time_not_want', $filters_for_time_not_want);

        //properties
        //gaunasi kad arba tas property arba tas gali buti
        if(count($filters_for_property_want) > 0){
            $query = $query->andWhere("s.id IN (:filters_for_property_want)")->setParameter('filters_for_property_want', $filters_for_property_want);
        }
        if(count($filters_for_property_not_want) > 0){
            $query = $query->andWhere("s.id NOT IN (:filters_for_property_not_want)")->setParameter('filters_for_property_not_want', $filters_for_property_not_want);
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

        //get ingredients_ID, image_url, title RANDOM
        //20 RANDOM ingredientu
        //later akcijos ir panasiai

        $products = [];
        $products[0] = ["0","/images/food (0).jpg", "title0"];
        $products[1] = ["1","/images/food (1).png", "title0"];
        $products[2] = ["2","/images/food (2).jpg", "title0"];
        $products[3] = ["3","/images/food (3).jpg", "title0"];
        $products[4] = ["4","/images/food (4).jpg", "title0"];
        $products[5] = ["5","/images/food (5).jpg", "title0"];
        $products[6] = ["6","/images/food (6).jpg", "title0"];
        $products[7] = ["7","/images/food (7).jpg", "title0"];
        $products[8] = ["8","/images/food (8).jpg", "title0"];
        $products[9] = ["9","/images/food (9).jpg", "title0"];
        $products[10] = ["10","/images/food (10).jpg", "title0"];

        $response = array(
            'status' => 'good',
            'products' => $products,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function load_shoppinglistAction(Request $request)
    {
        $request_data = $request->request;

        //from DB get shoppinglist and form shoppinglist_session

        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function filters_showAction(Request $request)
    {
        $request_data = $request->request;
        $type = $request_data->get('type');
        $category = $request_data->get('category');
        $em = $this->getDoctrine()->getManager();
        $filters = [];
        $filters_data = [];
        $selected_filters = [];

        $session = $request->getSession();
        //$session->remove('filters');
        if($session->has('filters')){
            $selected_filters = $session->get('filters');
        }

        //selected, selected_personal, categories, inside_category, ingredients
        switch($type){
            case "selected":
                //get select filters from session
                foreach($selected_filters as $selected_filter){
                    $type = $selected_filter["type"];
                    $id = $selected_filter["id"];
                    $indicator = $selected_filter["indicator"];
                    $filter_repository = $em->getRepository('NFQAkademijaBaseBundle:'.$type)->find($id);
                    $title = $filter_repository->getName();
                    $imageUrl = $filter_repository->getPhoto();

                    $filters_data[] = ['id' => $type.'-'.$id, 'title' => $title,'imageUrl' => $imageUrl, 'indicator' => $indicator, 'twig' => 'FilterSelected'];
                }
                break;
            case "selected_personal":
                //get select filters from DB for user
                foreach($selected_filters as $selected_filter){
                    $type = $selected_filter["type"];
                    $id = $selected_filter["id"];
                    $indicator = $selected_filter["indicator"];
                    $filter_repository = $em->getRepository('NFQAkademijaBaseBundle:'.$type)->find($id);
                    $title = $filter_repository->getName();
                    $imageUrl = $filter_repository->getPhoto();

                    $filters_data[] = ['id' => $type.'-'.$id, 'title' => $title,'imageUrl' => $imageUrl, 'indicator' => $indicator, 'twig' => 'FilterSelected'];
                }
                break;
            case "categories":
                //show all categories
                $filters_data[0] = ['id' => 'Type', 'title' => 'Tipai','imageUrl' => '/images/types.png', 'indicator' => '', 'twig' => 'FilterCategories'];
                $filters_data[1] = ['id' => 'Property', 'title' => 'Ypatybės', 'imageUrl' => '/images/properties.png', 'indicator' => '', 'twig' => 'FilterCategories'];
                $filters_data[2] = ['id' => 'CookingTime', 'title' => 'Laikai', 'imageUrl' => '/images/times.png', 'indicator' => '', 'twig' => 'FilterCategories'];
                $filters_data[3] = ['id' => 'Country', 'title' => 'Šalys', 'imageUrl' => '/images/countries.png', 'indicator' => '', 'twig' => 'FilterCategories'];
                $filters_data[4] = ['id' => 'Category', 'title' => 'Ingredientai', 'imageUrl' => '/images/ingredients_categories.png', 'indicator' => '', 'twig' => 'FilterCategories'];
                $filters_data[5] = ['id' => 'Celebration', 'title' => 'Šventės', 'imageUrl' => '/images/celebrations.png', 'indicator' => '', 'twig' => 'FilterCategories'];
                $filters_data[6] = ['id' => 'MainCookingMethod', 'title' => 'Gaminimo būdai', 'imageUrl' => '/images/cooking_methods.png', 'indicator' => '', 'twig' => 'FilterCategories'];

                break;
            case "inside_category":
                //from category get all ingredients and form $filters array
                //look in current filters session to see indicaators (want, not_want)

                $repository = $this->getDoctrine()->getRepository('NFQAkademijaBaseBundle:'.$category);
                $query = $repository->createQueryBuilder('f')
                    //select data
                    ->select('f.id, f.name, f.photo')
                    ->orderBy('f.name', 'ASC')
                    ->getQuery();
                $data = $query->getResult();

                if($category == "Category") {
                    $twig = "FilterIngredients";
                }else {
                    $twig = "FilterInside";
                }

                for($i = 0; $i < count($data); $i++ ){
                    $indicator = "";
                    foreach($selected_filters as $selected_filter){
                        $type = $selected_filter["type"];
                        $id = $selected_filter["id"];
                        if($type == $category && $id == $data[$i]['id']) {
                            $indicator = $selected_filter["indicator"];
                            break;
                        }
                    }

                    $filters_data[$i] = [
                        'id' => $category.'-'.$data[$i]['id'],
                        'title' => $data[$i]['name'],
                        'imageUrl' => $data[$i]['photo'],
                        'indicator' => $indicator,
                        'twig' => $twig,
                    ];
                }
                break;

            case "ingredients":
                $category = str_replace("Category-", "", $category);
                $repository = $this->getDoctrine()->getRepository('NFQAkademijaBaseBundle:Product');
                $query = $repository->createQueryBuilder('f')
                    ->select('f.id, f.name, f.photo')
                    ->where('f.category = :cat_id')
                    ->setParameter('cat_id', $category)
                    ->orderBy('f.name', 'ASC')
                    ->getQuery();
                $data = $query->getResult();

                for($i = 0; $i < count($data); $i++ ){
                    $indicator = "";
                    foreach($selected_filters as $selected_filter){
                        $type = $selected_filter["type"];
                        $id = $selected_filter["id"];
                        if($type == "Product" && $id == $data[$i]['id']) {
                            $indicator = $selected_filter["indicator"];
                            break;
                        }
                    }

                    $filters_data[$i] = [
                        'id' => "Product-".$data[$i]['id'],
                        'title' => $data[$i]['name'],
                        'imageUrl' => $data[$i]['photo'],
                        'indicator' =>  $indicator,
                        'twig' => 'FilterInside'
                    ];
                }
                break;
        }



        for($i = 0; $i < count($filters_data); $i++){
            $id = $filters_data[$i]['id'];
            $title = $filters_data[$i]['title'];
            $imageUrl = $filters_data[$i]['imageUrl'];
            $indicator = $filters_data[$i]['indicator'];
            $twig = $filters_data[$i]['twig'];
            $filter_data = $this->render('NFQAkademijaRecipesBundle:AjaxViews:'.$twig.'.html.twig',
                array(
                    'id' => $id,
                    'title' => $title,
                    'imageUrl' => $imageUrl,
                    'indicator' => $indicator,
                ));
            $filters[] = $filter_data->getContent();
        }

        $response = array(
            'status' => 'good',
            'filters' => $filters,
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

    public function filter_indicator_changeAction(Request $request)
    {
        $request_data = $request->request;
        $filter_type = $request_data->get('type');
        $filter_id = $request_data->get('id');
        $filter_indicator = $request_data->get('indicator');

        //change indicator in current filters session
        //want, not_want, none
        //none = delete
        //if not exists - add to session
        //$filters[0] = ["id" => '5', "type" => 'country', "indicator" => "want"];
        $session = $request->getSession();
        //$session->remove('filters');
        if($session->has('filters')){
            //if at least one filter exists
            $i = 0;
            $exists = false;
            $filters = $session->get('filters');
            foreach($filters as $filter){
                $type = $filter["type"];
                $id = $filter["id"];
                //if filter is already existing
                if($type == $filter_type && $id == $filter_id){
                    if($filter_indicator == "none"){
                        unset($filters[$i]);
                        $filters = array_values($filters);
                    }else{
                        $filters[$i]["indicator"] = $filter_indicator;
                    }
                    $exists = true;
                    break;
                }else{
                    $i++;
                }
            }
            //if filter is not in array
            if(!$exists){
                $new_filter = ["id" => $filter_id, "type" => $filter_type, "indicator" => $filter_indicator];
                $filters [] = $new_filter;
            }
        }else{
            //if no filter exists
            $filters = [];
            $filters[0] = ["id" => $filter_id, "type" => $filter_type, "indicator" => $filter_indicator];
        }

        $session->set('filters', $filters);

        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function shoppinglist_addAction(Request $request)
    {
        $request_data = $request->request;

        $id = $request_data->get("shoppinglist_add_id");
        $title = $request_data->get("shoppinglist_add_title");

        //add to user db and current shoppinglist session

        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function shoppinglist_product_addAction(Request $request)
    {
        $request_data = $request->request;

        $id = $request_data->get("product_id");

        //add to user db and current shoppinglist session

        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function shoppinglist_deleteAction(Request $request)
    {
        $request_data = $request->request;

        $shoppinglist_type = $request_data->get("shoppinglist_type");
        $shoppinglist_id = $request_data->get("shoppinglist_id");

        //delete from user db and current shopinglist session

        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function filter_search_addAction(Request $request)
    {
        $request_data = $request->request;
        $filter_type = $request_data->get("filter_type");
        $filter_id = $request_data->get("filter_id");
        $filter_indicator = $request_data->get("filter_indicator");

        //add filter to current session

        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function searchAction(Request $request)
    {
        //from search value get filters and recipes. do not show which are already selected in current filters session
        //$good_data[] = ["id" => $id, "imageUrl" => $imageUrl, "title" => $title, "info" => $info]
        //search in: Celebration, CookingTime, Country, MainCookingMethod, Product, Property, Recipe, Type,

        $request_data = $request->request;
        $value = $request_data->get('search');
        $good_data = [];
        $search_zones = ["Celebration", "CookingTime", "Country", "MainCookingMethod", "Product", "Property", "Recipe", "Type"];

        foreach($search_zones as $zone){
            $data = [];
            $repository = $this->getDoctrine()->getRepository('NFQAkademijaBaseBundle:'.$zone);
            $query = $repository->createQueryBuilder('f')
                ->select('f.id, f.name, f.photo')
                ->where('f.name LIKE :name')
                ->setParameter('name', $value.'%')
                ->orderBy('f.name', 'ASC')
                ->getQuery();
            $data = $query->getResult();
            $twig = "SearchItem";
            switch($zone){
                case "Celebration": $info = "Šventė"; break;
                case "CookingTime": $info = "Laikas"; break;
                case "Country": $info = "Šalis"; break;
                case "MainCookingMethod": $info = "Gaminimo būdas"; break;
                case "Product": $info = "Ingredientas"; break;
                case "Property": $info = "Ypatybė"; break;
                case "Recipe": $info = "Patiekalas"; $twig = "SearchRecipe"; break;
                case "Type": $info = "Tipas"; break;
            }

            foreach($data as $dat){
                $good_data[] = ["id" => $dat['id'], "type" => $zone, "title" => $dat['name'], "imageUrl" => $dat['photo'], "info" => $info, "twig" => $twig];
            }
        }

        //check current filters to not duplicate search results
        $selected_filters = [];
        $session = $request->getSession();
        if($session->has('filters')){
            $selected_filters = $session->get('filters');
        }

        foreach($good_data as $data){
            $found = false;
            foreach($selected_filters as $selected_filter){
                $type = $selected_filter["type"];
                $id = $selected_filter["id"];
                if($data['id'] == $id && $data['type'] == $type){
                    $found = true;
                    break;
                }
            }
            if(!$found){
                if($data['twig'] == "SearchRecipe"){
                    $id = $data['id'];
                }else{
                    $id = $data['type'].'-'.$data['id'];
                }

                $title = $data['title'];
                $imageUrl = $data['imageUrl'];
                $info = $data['info'];
                $twig = $data['twig'];

                $filter_data = $this->render('NFQAkademijaRecipesBundle:AjaxViews:'.$twig.'.html.twig',
                    array(
                        'id' => $id,
                        'title' => $title,
                        'imageUrl' => $imageUrl,
                        'info' => $info,
                    ));
                $search_data[] = $filter_data->getContent();
            }
        }


        $response = array(
            'status' => 'good',
            'search_data' => $search_data,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function search_shoppinglistAction(Request $request)
    {
        $request_data = $request->request;
        $value = $request_data->get('search');
        //from search value get ingredients. do not show which are in current shoppinglist session
        //get ingredientID, title, type, imageUrl


        $search_data = [];
        $search_data[0] =
            "<div class='s_e search_item untouchable' id='shoppinglist-ingredient-95' onclick='shoppinglist_add(this.id)'>".
                "<div class='s_e search_item_image' style=\"background-image:url('images/food (2).jpg')\"></div>".
                "<div class='s_e search_item_title'>Ananasas</div>".
                "<div class='s_e search_item_bottom_info'>Ingredientas</div>".
            "</div>";

        $response = array(
            'status' => 'good',
            'search_data' => $search_data,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function search_placesAction(Request $request)
    {
        $request_data = $request->request;
        $value = $request_data->get('search');
        //from search value get places.
        //get title, imageUrl, type

        $search_data = [];
        $search_data[0] =
            "<div class='s_e search_item untouchable' id='search-maxima' onclick=\"show_nearest('maxima');\">".
                "<div class='s_e search_item_image' style=\"background-image:url('/images/maxima.png')\"></div>".
                "<div class='s_e search_item_title'>Maxima</div>".
                "<div class='s_e search_item_bottom_info'>Parduotuvė</div>".
            "</div>";

        $response = array(
            'status' => 'good',
            'search_data' => $search_data,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function recipe_right_sidebarAction(Request $request)
    {
        //info apie recipe
        //title, like_status, id, like_amount, author, cooking_time, country, main_cooking_method,
        //type, properties, celebration, ingredients(imageUrl, title, amount, unit), imageUrl,
        $request_data = $request->request;
        $recipe_ID = $request_data->get('recipe_ID');

        $em = $this->getDoctrine()->getManager();
        $recipe = $em->getRepository('NFQAkademijaBaseBundle:Recipe')->find($recipe_ID);

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
            // 4 user id
            $user_ID = '4';
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

    public function ingredient_addAction(Request $request)
    {
        $request_data = $request->request;
        $ingredient_ID = $request_data->get('ingredient_ID');
        //add to current shoppinglist session and to users_shoppinglist in database ingredient and quantity

        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function ingredient_add_allAction(Request $request)
    {
        $request_data = $request->request;
        $recipe_ID = $request_data->get('recipe_ID');
        //add to current shoppinglist session and to users_shoppinglist in database ingredients and quantities
        //get ingredients and quantities from recipe_ID
        //sum up quantities
        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function ingredient_deleteAction(Request $request)
    {
        $request_data = $request->request;

        $ingredient_ID = $request_data->get('ingredient_ID');
        //delete ingredient and quantity from current shoppinglist session and users_shoppinglist in database

        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function coop_infoAction(Request $request)
    {
        $request_data = $request->request;
        $recipe_ID = $request_data->get('recipe_ID');
        //add info that user cooperated

        $response = array(
            'status' => 'good',
        );
        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function loginAction(Request $request)
    {
        $request_data = $request->request;

        //create session that user is loged in
        //change profile navigation bar



        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function likeAction(Request $request)
    {
        $request_data = $request->request;
        $recipe_ID = $request_data->get('recipe_ID');
        $em = $this->getDoctrine()->getManager();

        // 4 user id need from session
        $user_ID = 4;

        $like_status = $em->getRepository("NFQAkademijaBaseBundle:Like")->find(array("user" => $user_ID, "recipe" => $recipe_ID));
        if($like_status){
            $new_like_status = "not_liked";
            //update to not like
            $em->remove($like_status);
        }else{
            $new_like_status = "liked";
            //update to like
            $data = new Like();
            $user = $em->getRepository("NFQAkademijaBaseBundle:User")->find($user_ID);
            $recipe = $em->getRepository("NFQAkademijaBaseBundle:Recipe")->find($recipe_ID);
            $data->setUser($user);
            $data->setRecipe($recipe);
            $em->persist($data);
        }

        $em->flush();


        $response = array(
            'status' => 'good',
            'like_status' => $new_like_status,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function shareAction(Request $request)
    {
        $request_data = $request->request;

        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function commentAction(Request $request)
    {
        $request_data = $request->request;
        $recipe_ID = $request_data->get('recipe_ID');
        $comment = $request_data->get('comment');

        //add comment to recipe

        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_logoutAction(Request $request)
    {
        $request_data = $request->request;

        //delete login session
        //change back profile navigation

        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_loginAction(Request $request)
    {
        $request_data = $request->request;

        //create admin session

        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function load_moreAction(Request $request)
    {
        $request_data = $request->request;
        //check if there is results to retreive and increase limit session by 10
        //if no results send 'end' => true else 'end' => false

        $response = array(
            'status' => 'good',
            'end' => true,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function nearest_placeAction(Request $request)
    {
        $request_data = $request->request;
        $title = $request_data->get('title');

        //from DB get nearest place with that TITLE
        $place = [$title, $title,'55.909933', '23.983622', '/images/maxima.png'];

        $response = array(
            'status' => 'good',
            'place' => $place,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function custom_placeAction(Request $request)
    {
        $request_data = $request->request;
        $type = $request_data->get('type');
        $radius = $request_data->get('radius');

        //from DB get all places with TYPE and in that RADIUS
        $places = [];
        $places[0] = ['Maxima','tipas0','54.909933', '23.983622', '/images/maxima.png'];
        $places[1] = ['Norfa','tipas0','54.910833', '23.976841', '/images/norfa.png'];
        $places[2] = ['Iki','tipas0','54.907780', '23.983622', '/images/iki.png'];
        $places[3] = ['Hesburger','tipas0','54.906690', '23.983640', '/images/hesburger.png'];
        $places[4] = ['McDonalds','tipas0','54.907000', '23.983648', '/images/mcdonalds.png'];
        $places[5] = ['Rimi','tipas0','54.909933', '23.983670', '/images/rimi.png'];

        $response = array(
            'status' => 'good',
            'places' => $places,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_new_dataAction(Request $request)
    {
        $request_data = $request->request;
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $data_type = ucfirst($request_data->get('data_type'));
        $inserted_data = "";

        switch($data_type){
            case "Fact":
                //get data
                $fact_text = $request_data->get('fact_text');

                //set data
                $data = new Fact();
                $data->setText($fact_text);

                //insert data into DB
                $em->persist($data);
                $em->flush();


                //get inserted data
                $repository = $this->getDoctrine()->getRepository('NFQAkademijaBaseBundle:'.$data_type);
                $query = $repository->createQueryBuilder('f')
                    //select data
                    ->select('f.id, f.text')
                    ->setMaxResults(1)
                    ->orderBy('f.id', 'DESC')
                    ->getQuery();
                $latest_data = $query->getSingleResult();

                $id = $latest_data["id"];
                $text = $latest_data["text"];

                $inserted_data = $this->render('NFQAkademijaRecipesBundle:AjaxViews:'.$data_type.'.html.twig',
                    array(
                        'id' => $id,
                        'text' => $text,
                    ));
                $inserted_data = $inserted_data->getContent();

                break;
            case "Comment":
                //get data
                $text = $request_data->get('text');
                $recipe_id = $request_data->get('recipe_id');
                $user_id = '1';

                //set data
                $data = new Comment();
                $data->setText($text);
                $data->setUser($user_id);
                $data->setRecipe($recipe_id);

                //insert data into DB
                $em->persist($data);
                $em->flush();


                //get inserted data
                $repository = $this->getDoctrine()->getRepository('NFQAkademijaBaseBundle:'.$data_type);
                $query = $repository->createQueryBuilder('f')
                    //select data
                    ->select('f.id, f.text, f.user, f.recipe')
                    ->setMaxResults(1)
                    ->orderBy('f.id', 'DESC')
                    ->getQuery();
                $latest_data = $query->getSingleResult();

                $id = $latest_data["id"];
                $text = $latest_data["text"];
                $user = $latest_data["user"];
                $recipe = $latest_data["recipe"];

                $inserted_data = $this->render('NFQAkademijaRecipesBundle:AjaxViews:'.$data_type.'.html.twig',
                    array(
                        'id' => $id,
                        'text' => $text,
                    ));
                $inserted_data = $inserted_data->getContent();

                break;
        }

        $response = array(
            'status' => 'good',
            'inserted_data' => $inserted_data,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_load_dataAction(Request $request)
    {
        $request_data = $request->request;
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $data_type = ucfirst($request_data->get('data_type'));
        $loaded_data = [];

        switch($data_type){
            case "Fact":
                $data = $em->getRepository('NFQAkademijaBaseBundle:'.$data_type)->findAll();
                foreach($data as $single_data){
                    //get data
                    $text = $single_data->getText();
                    $id = $single_data->getId();

                    //set data
                    $html_data = $this->render('NFQAkademijaRecipesBundle:AjaxViews:'.$data_type.'.html.twig',
                        array(
                            'id' => $id,
                            'text' => $text,
                        ));
                    $html_data = $html_data->getContent();
                    $loaded_data [] = $html_data;
                }
                break;
        }

        $response = array(
            'status' => 'good',
            'loaded_data' => $loaded_data,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_delete_dataAction(Request $request)
    {
        $request_data = $request->request;
        $id = $request_data->get('id');
        $data_type = ucfirst($request_data->get('data_type'));

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('NFQAkademijaBaseBundle:'.$data_type)->find($id);
        $em->remove($data);
        $em->flush();

        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_save_dataAction(Request $request)
    {
        $request_data = $request->request;
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $data_type = ucfirst($request_data->get('data_type'));
        $id = $request_data->get('id');

        switch($data_type){
            case "Fact":
                $data = $em->getRepository('NFQAkademijaBaseBundle:'.$data_type)->find($id);

                //get data
                $fact_text = $request_data->get('fact_text');

                //set data
                $data->setText($fact_text);

                break;
        }

        $em->flush();
        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_load_selectsAction(Request $request)
    {
        $request_data = $request->request;
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $select_type = ucfirst($request_data->get('select_type'));
        $select_data = [];

        switch($select_type){
            case "Recipe":
                $data = $em->getRepository('NFQAkademijaBaseBundle:'.$select_type)->findAll();
                $select_array = [];
                foreach($data as $single_data){
                    //get data
                    $id = $single_data->getId();
                    $title = $single_data->getName();


                    //set data
                    $select_array[] = ["id" => $id, "title" => $title];
                }

                $html_data = $this->render('NFQAkademijaRecipesBundle:AjaxViews:SelectOption'.$select_type.'.html.twig',
                    array(
                        'select_array' => $select_array,
                    ));
                $html_data = $html_data->getContent();
                $select_data [] = $html_data;
                break;
        }

        $response = array(
            'status' => 'good',
            'select_data' => $select_data,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }
}


/*
$dql = "SELECT f FROM NFQAkademijaBaseBundle:Fact f ORDER BY f.id DESC LIMIT 1";
$query = $em->createQuery($dql);
*/
//file_put_contents('log.log', print_r($latest_data, true), FILE_APPEND);
//find grazina entity, visi kiti arrejus
//get recipe_ID, image_url, title and limit and form recipes array
//[id, imageUrl, title]
//WHERE filters occur

/*
$recipes[0] = ["0","/images/food (0).jpg", "title0"];
$recipes[1] = ["1","/images/food (1).png", "title0"];
$recipes[2] = ["2","/images/food (2).jpg", "title0"];
$recipes[3] = ["3","/images/food (3).jpg", "title0"];
$recipes[4] = ["4","/images/food (4).jpg", "title0"];
$recipes[5] = ["5","/images/food (5).jpg", "title0"];
$recipes[6] = ["6","/images/food (6).jpg", "title0"];
$recipes[7] = ["7","/images/food (7).jpg", "title0"];
$recipes[8] = ["8","/images/food (8).jpg", "title0"];
$recipes[9] = ["9","/images/food (9).jpg", "title0"];
$recipes[10] = ["10","/images/food (10).jpg", "title0"];
$recipes[11] = ["11","/images/food (11).jpg", "title0"];
*/// 'WITH', 'p.product = ?filters_for_ingredients_want')->setParameter('filters_for_ingredients_want', $filters_for_ingredients_want);
//if(count($filters_for_property_want) > 0)
    //$query = $query->join('f.properties', 's', 'WITH', 's.id = :filters_for_property_want')->setParameter('filters_for_property_want', $filters_for_property_want);
/*
       SELECT recipes.id, recipes.name, recipes.photo, recipe_property.property_id
       FROM recipes
       INNER JOIN recipe_property ON recipes.id = recipe_property.recipe_id
       WHERE recipe_property.property_id = 1
        */