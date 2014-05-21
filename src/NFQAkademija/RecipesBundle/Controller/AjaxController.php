<?php

namespace NFQAkademija\RecipesBundle\Controller;

use Doctrine\ORM\EntityManager;
use NFQAkademija\BaseBundle\Entity\Recipe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use NFQAkademija\BaseBundle\Entity\Fact;
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

    public function profile_recipesAction(Request $request)
    {
        $request_data = $request->request;

        $type = $request_data->get('type');

        //get recipe_ID, image_url, title which user cooked, liked or created TYPE
        //[id, imageUrl, title]

        $repository = $this->getDoctrine()->getRepository('NFQAkademijaBaseBundle:Recipe');
        $query = $repository->createQueryBuilder('f')
            ->select('f.id, f.name, f.photo')
            ->orderBy('f.name', 'ASC')
            ->getQuery();

        $data = $query->getResult();


        $recipes = [];

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

        $response = array(
            'status' => 'good',
            'recipes' => $recipes,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function load_recipesAction(Request $request)
    {
        $request_data = $request->request;
        $reset = $request_data->get('reset');
        $limit = 20;
        $offset = 0; //get offset from session

        if($reset == "true"){
            //reset limit to 0 - LIMIT 10, 0;
            $offset = 0;

        }

        $repository = $this->getDoctrine()->getRepository('NFQAkademijaBaseBundle:Recipe');
        $query = $repository->createQueryBuilder('f')
            ->select('f.id, f.name, f.photo')
            ->orderBy('f.name', 'ASC')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery();

        $data = $query->getResult();

        //increase in session
        $offset += 10;

        //get recipe_ID, image_url, title and limit and form recipes array
        //[id, imageUrl, title]
        //WHERE filters occur
        $recipes = [];
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

        $response = array(
            'status' => 'good',
            'recipes' => $recipes,
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

        file_put_contents('log.log', print_r($selected_filters, true), FILE_APPEND);
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

        //hide_loading_screen sunaikina sesija
        //tada kita karta iskvietus show_loading_screen susikurs sesija su random faktu ir jy rodys kol
        //uzkraus psulapy ir kai uzkraus kol iskvies hide_loading_screen
        $fact = "";

        if($status == "start"){
            //create session with random fact
            $repository = $this->getDoctrine()->getRepository('NFQAkademijaBaseBundle:Fact');
            $query = $repository->createQueryBuilder('f')
                ->select('f.text')
                //->orderBy('RAND()')
                ->getQuery();
            $data = $query->getSingleResult();
            $fact = $data["text"];

            $session = $request->getSession();
            $session->set('loading_screen', $fact);
        }else{
            //delete session
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
                        file_put_contents('log.log', print_r($filters, true), FILE_APPEND);
                        unset($filters[$i]);
                        file_put_contents('log.log', print_r($filters, true), FILE_APPEND);
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
        $request_data = $request->request;
        $recipe_ID = $request_data->get('recipe_ID');

        /*
        $repository = $this->getDoctrine()->getRepository('NFQAkademijaBaseBundle:Recipe');
        $recipe = $repository->find('1');

        $products = $recipe->getProducts();
        $name = $recipe->getName();
        file_put_contents('log.log', print_r($products, true), FILE_APPEND);
        */
        //from recipe_ID get all ingredients:id, imageUrl, title, amount, unit
        //from current shoppinglist and current filters session get
        $ingredients = "";
        $ingredient_ID = '2';
        $ingredient_imageUrl = "/images/food (5).jpg";
        $ingredient_title = "Bananas";
        $ingredient_quantity = "5";
        $ingredient_unit = "vnt";
        $ingredient_indicator = "have"; // have, shoppinglist, undefined

        $ingredient = $this->render('NFQAkademijaRecipesBundle:AjaxViews:Ingredient.html.twig',
            array(
                'id' => $ingredient_ID,
                'title' => $ingredient_title,
                'imageUrl' => $ingredient_imageUrl,
                'quantity' => $ingredient_quantity,
                'unit' => $ingredient_unit,
                'indicator' => $ingredient_indicator,
            ));
        $ingredient = $ingredient->getContent();
        $ingredients .= $ingredient;
        $ingredients .= $ingredient;
        $ingredients .= $ingredient;


        $title = "bla";
        $imageUrl = "/images/food (5).jpg";
        $like_status = "not_liked";
        $like_count = "59";
        $author = "autorius";
        $time = "25 min";
        $country = "Lenkija";
        $type = "Antrijie";
        $main_cooking_method = "Virimas";
        $properties = "Aštru, sūru";
        $celebration = "Kalėdos";

        $recipe_data = $this->render('NFQAkademijaRecipesBundle:AjaxViews:RecipeRightSidebar.html.twig',
            array(
                'id' => $recipe_ID,
                'title' => $title,
                'imageUrl' => $imageUrl,
                'like_status' => $like_status,
                'like_count' => $like_count,
                'author' => $author,
                'time' => $time,
                'country' => $country,
                'type' => $type,
                'main_cooking_method' => $main_cooking_method,
                'properties' => $properties,
                'celebration' => $celebration,
                'ingredients' => $ingredients,
            ));
        $recipe_data = $recipe_data->getContent();

        $response = array(
            'status' => 'good',
            'recipe_data' => $recipe_data,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function user_cookingAction(Request $request)
    {
        $request_data = $request->request;

        $recipe_ID = $request_data->get('recipe_ID');
        //add to user that he is cooking this recipe


        $response = array(
            'status' => 'good',
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

        //add to user that he liked this recipe
        $response = array(
            'status' => 'good',
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