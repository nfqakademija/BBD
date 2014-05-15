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

        $type = $request_data->get('profile_recipes_type');

        //get recipe_ID, image_url, title which user cooked, liked or created TYPE
        //[id, imageUrl, title]
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

        if($reset == "true"){
            //reset limit to 0 - LIMIT 10, 0;
        }

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

    public function append_shoppinglistAction(Request $request)
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

    public function filter_startAction(Request $request)
    {
        $request_data = $request->request;

        //show first filters types
        $filters = [];
        $filters[0] = "<div class='filter_element untouchable' id='types' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/types.png');\"></div><div class='filter_element_text'>Tipai</div></div>";
        $filters[1] = "<div class='filter_element untouchable' id='characteristics' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/characteristics.png');\"></div><div class='filter_element_text'>Ypatybės</div></div>";
        $filters[2] = "<div class='filter_element untouchable' id='times' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/times.png');\"></div><div class='filter_element_text'>Laikai</div></div>";
        $filters[3] = "<div class='filter_element untouchable' id='countries' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/countries.png');\"></div><div class='filter_element_text'>Šalys</div></div>";
        $filters[4] = "<div class='filter_element untouchable' id='ingredients_categories' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/ingredients_categories.png');\"></div><div class='filter_element_text'>Ingredientai</div></div>";
        $filters[5] = "<div class='filter_element untouchable' id='celebrations' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/celebrations.png');\"></div><div class='filter_element_text'>Šventės</div></div>";
        $filters[6] = "<div class='filter_element untouchable' id='cooking_methods' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/cooking_methods.png');\"></div><div class='filter_element_text'>Gaminimo būdai</div></div>";


        $response = array(
            'status' => 'good',
            'filters' => $filters,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function filter_categoryAction(Request $request)
    {
        $request_data = $request->request;


        $category = $request_data->get('filter_category');
        //get filters categories in specific type
        $filters = [];
        switch($category){
            case "types":
                $filters[0] = "<div class='filter_element untouchable' id='types_1' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/drinks.png');\"></div><div class='filter_element_text'>Gėrimai</div><div class='filter_element_indicator' id='indicator_types_1'></div></div>";
                $filters[1] = "<div class='filter_element untouchable' id='types_2' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/pastries.png');\"></div><div class='filter_element_text'>Kepiniai</div><div class='filter_element_indicator' id='indicator_types_2'></div></div>";
                $filters[2] = "<div class='filter_element untouchable' id='types_3' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/desserts.png');\"></div><div class='filter_element_text'>Desertai</div><div class='filter_element_indicator' id='indicator_types_3'></div></div>";
                $filters[3] = "<div class='filter_element untouchable' id='types_4' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/second_dishes.png');\"></div><div class='filter_element_text'>Antrieji patiekalai</div><div class='filter_element_indicator' id='indicator_types_4'></div></div>";
                $filters[4] = "<div class='filter_element untouchable' id='types_5' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/canned_meals.png');\"></div><div class='filter_element_text'>Konservuoti patiekalai</div><div class='filter_element_indicator' id='indicator_types_5'></div></div>";
                $filters[5] = "<div class='filter_element untouchable' id='types_6' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/porridges.png');\"></div><div class='filter_element_text'>Košės</div><div class='filter_element_indicator' id='indicator_types_6'></div></div>";
                $filters[6] = "<div class='filter_element untouchable' id='types_7' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('images/salads.png');\"></div><div class='filter_element_text'>Salotos</div><div class='filter_element_indicator' id='indicator_types_7'></div></div>";
                $filters[7] = "<div class='filter_element untouchable' id='types_8' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/soups.png');\"></div><div class='filter_element_text'>Sriubos</div><div class='filter_element_indicator' id='indicator_types_8'></div></div>";
                $filters[8] = "<div class='filter_element untouchable' id='types_9' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/sandwitches.png');\"></div><div class='filter_element_text'>Sumuštiniai</div><div class='filter_element_indicator' id='indicator_types_9'></div></div>";
                $filters[9] = "<div class='filter_element untouchable' id='types_10' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/stews.png');\"></div><div class='filter_element_text'>Troškiniai</div><div class='filter_element_indicator' id='indicator_types_10'></div></div>";
                $filters[10] = "<div class='filter_element untouchable' id='types_11' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/jams.png');\"></div><div class='filter_element_text'>Uogienės</div><div class='filter_element_indicator' id='indicator_types_11'></div></div>";
                $filters[11] = "<div class='filter_element untouchable' id='types_12' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/snacks.png');\"></div><div class='filter_element_text'>Užkandžiai</div><div class='filter_element_indicator' id='indicator_types_12'></div></div>";
                $filters[12] = "<div class='filter_element untouchable' id='types_13' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/sauces.png');\"></div><div class='filter_element_text'>Padažai</div><div class='filter_element_indicator' id='indicator_types_13'></div></div>";
            break;
            case "times":
                $filters[0] = "<div class='filter_element untouchable' id='times_1' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/times.png');\"></div><div class='filter_element_text'>Iki 5min</div><div class='filter_element_indicator' id='indicator_times_1'></div></div>";
                $filters[1] = "<div class='filter_element untouchable' id='times_2' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/times.png');\"></div><div class='filter_element_text'>Iki 10min</div><div class='filter_element_indicator' id='indicator_times_2'></div></div>";
                $filters[2] = "<div class='filter_element untouchable' id='times_3' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/times.png');\"></div><div class='filter_element_text'>Iki 15min</div><div class='filter_element_indicator' id='indicator_times_3'></div></div>";
                $filters[3] = "<div class='filter_element untouchable' id='times_4' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/times.png');\"></div><div class='filter_element_text'>Iki 20min</div><div class='filter_element_indicator' id='indicator_times_4'></div></div>";
                $filters[4] = "<div class='filter_element untouchable' id='times_5' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/times.png');\"></div><div class='filter_element_text'>Iki 25min</div><div class='filter_element_indicator' id='indicator_times_5'></div></div>";
                $filters[5] = "<div class='filter_element untouchable' id='times_6' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/times.png');\"></div><div class='filter_element_text'>Iki 30min</div><div class='filter_element_indicator' id='indicator_times_6'></div></div>";
                $filters[6] = "<div class='filter_element untouchable' id='times_7' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/times.png');\"></div><div class='filter_element_text'>Iki 45min</div><div class='filter_element_indicator' id='indicator_times_7'></div></div>";
                $filters[7] = "<div class='filter_element untouchable' id='times_8' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/times.png');\"></div><div class='filter_element_text'>Iki 1h</div><div class='filter_element_indicator' id='indicator_times_8'></div></div>";
                $filters[8] = "<div class='filter_element untouchable' id='times_9' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/times.png');\"></div><div class='filter_element_text'>Iki 1h 30min</div><div class='filter_element_indicator' id='indicator_times_9'></div></div>";
                $filters[9] = "<div class='filter_element untouchable' id='times_10' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/times.png');\"></div><div class='filter_element_text'>Iki 2h</div><div class='filter_element_indicator' id='indicator_times_10'></div></div>";
                $filters[10] = "<div class='filter_element untouchable' id='times_11' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/times.png');\"></div><div class='filter_element_text'>Iki 3h</div><div class='filter_element_indicator' id='indicator_times_11'></div></div>";
            break;
            case "characteristics":
                $filters[0] = "<div class='filter_element untouchable' id='characteristics_1' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/hot.png');\"></div><div class='filter_element_text'>Aštru</div><div class='filter_element_indicator' id='indicator_characteristics_1'></div></div>";
                $filters[1] = "<div class='filter_element untouchable' id='characteristics_2' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/sour.png');\"></div><div class='filter_element_text'>Rūgštu</div><div class='filter_element_indicator' id='indicator_characteristics_2'></div></div>";
                $filters[2] = "<div class='filter_element untouchable' id='characteristics_3' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/salty.png');\"></div><div class='filter_element_text'>Sūru</div><div class='filter_element_indicator' id='indicator_characteristics_3'></div></div>";
                $filters[3] = "<div class='filter_element untouchable' id='characteristics_4' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/exotic.png');\"></div><div class='filter_element_text'>Egzotiška</div><div class='filter_element_indicator' id='indicator_characteristics_4'></div></div>";
                $filters[4] = "<div class='filter_element untouchable' id='characteristics_5' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/cheap.png');\"></div><div class='filter_element_text'>Pigu</div><div class='filter_element_indicator' id='indicator_characteristics_5'></div></div>";
                $filters[5] = "<div class='filter_element untouchable' id='characteristics_6' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/fast.png');\"></div><div class='filter_element_text'>Greita</div><div class='filter_element_indicator' id='indicator_characteristics_6'></div></div>";
                $filters[6] = "<div class='filter_element untouchable' id='characteristics_7' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/spicy.png');\"></div><div class='filter_element_text'>Pikantiška</div><div class='filter_element_indicator' id='indicator_characteristics_7'></div></div>";
                $filters[7] = "<div class='filter_element untouchable' id='characteristics_8' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/breakfast.png');\"></div><div class='filter_element_text'>Pusryčiams</div><div class='filter_element_indicator' id='indicator_characteristics_8'></div></div>";
                $filters[8] = "<div class='filter_element untouchable' id='characteristics_10' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/lunch.png');\"></div><div class='filter_element_text'>Pietums</div><div class='filter_element_indicator' id='indicator_characteristics_10'></div></div>";
                $filters[9] = "<div class='filter_element untouchable' id='characteristics_11' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/dinner.png');\"></div><div class='filter_element_text'>Vakarienei</div><div class='filter_element_indicator' id='indicator_characteristics_11'></div></div>";
                $filters[10] = "<div class='filter_element untouchable' id='characteristics_12' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/sweden_table.png');\"></div><div class='filter_element_text'>Švediškam stalui</div><div class='filter_element_indicator' id='indicator_characteristics_12'></div></div>";
                $filters[11] = "<div class='filter_element untouchable' id='characteristics_13' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/beer.png');\"></div><div class='filter_element_text'>Užkanda prie alaus</div><div class='filter_element_indicator' id='indicator_characteristics_13'></div></div>";
                $filters[12] = "<div class='filter_element untouchable' id='characteristics_14' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/vegatarian.png');\"></div><div class='filter_element_text'>Vegetariška</div><div class='filter_element_indicator' id='indicator_characteristics_14'></div></div>";
                $filters[13] = "<div class='filter_element untouchable' id='characteristics_15' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/vegan.png');\"></div><div class='filter_element_text'>Veganiška</div><div class='filter_element_indicator' id='indicator_characteristics_15'></div></div>";
                $filters[14] = "<div class='filter_element untouchable' id='characteristics_16' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/for_kids.png');\"></div><div class='filter_element_text'>Vaikams</div><div class='filter_element_indicator' id='indicator_characteristics_16'></div></div>";
                $filters[15] = "<div class='filter_element untouchable' id='characteristics_17' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/diet.png');\"></div><div class='filter_element_text'>Dietinis</div><div class='filter_element_indicator' id='indicator_characteristics_17'></div></div>";
                $filters[16] = "<div class='filter_element untouchable' id='characteristics_18' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/health.png');\"></div><div class='filter_element_text'>Gydomasis</div><div class='filter_element_indicator' id='indicator_characteristics_18'></div></div>";
            break;

            case "countries":
                $filters[0] = "<div class='filter_element untouchable' id='countries_1' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Lietuva</div><div class='filter_element_indicator' id='indicator_countries_1'></div></div>";
                $filters[1] = "<div class='filter_element untouchable' id='countries_2' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Švedija</div><div class='filter_element_indicator' id='indicator_countries_2'></div></div>";
                $filters[2] = "<div class='filter_element untouchable' id='countries_3' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>JAV</div><div class='filter_element_indicator' id='indicator_countries_3'></div></div>";
                $filters[3] = "<div class='filter_element untouchable' id='countries_4' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Kinija</div><div class='filter_element_indicator' id='indicator_countries_4'></div></div>";
                $filters[4] = "<div class='filter_element untouchable' id='countries_5' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Turkija</div><div class='filter_element_indicator' id='indicator_countries_5'></div></div>";
            break;

            case "celebrations":
                $filters[0] = "<div class='filter_element untouchable' id='celebrations_1' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/birthday.png');\"></div><div class='filter_element_text'>Gimtadienis</div><div class='filter_element_indicator' id='indicator_celebrations_1'></div></div>";
                $filters[1] = "<div class='filter_element untouchable' id='celebrations_2' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Helauvynas</div><div class='filter_element_indicator' id='indicator_celebrations_2'></div></div>";
                $filters[2] = "<div class='filter_element untouchable' id='celebrations_3' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Kalėdos</div><div class='filter_element_indicator' id='indicator_celebrations_3'></div></div>";
                $filters[3] = "<div class='filter_element untouchable' id='celebrations_4' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Kūčios</div><div class='filter_element_indicator' id='indicator_celebrations_4'></div></div>";
                $filters[4] = "<div class='filter_element untouchable' id='celebrations_5' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Užgavėnės</div><div class='filter_element_indicator' id='indicator_celebrations_5'></div></div>";
                $filters[5] = "<div class='filter_element untouchable' id='celebrations_6' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Velykos</div><div class='filter_element_indicator' id='indicator_celebrations_6'></div></div>";
                $filters[6] = "<div class='filter_element untouchable' id='celebrations_7' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Vestuvės</div><div class='filter_element_indicator' id='indicator_celebrations_7'></div></div>";
            break;

            case "cooking_methods":
                $filters[0] = "<div class='filter_element untouchable' id='cooking_methods_1' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Grilyje</div><div class='filter_element_indicator' id='indicator_cooking_methods_1'></div></div>";
                $filters[1] = "<div class='filter_element untouchable' id='cooking_methods_2' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Džiovinti</div><div class='filter_element_indicator' id='indicator_cooking_methods_2'></div></div>";
                $filters[2] = "<div class='filter_element untouchable' id='cooking_methods_3' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Garuose</div><div class='filter_element_indicator' id='indicator_cooking_methods_3'></div></div>";
                $filters[3] = "<div class='filter_element untouchable' id='cooking_methods_4' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Kepti</div><div class='filter_element_indicator' id='indicator_cooking_methods_4'></div></div>";
                $filters[4] = "<div class='filter_element untouchable' id='cooking_methods_5' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Išmaišyti</div><div class='filter_element_indicator' id='indicator_cooking_methods_5'></div></div>";
                $filters[5] = "<div class='filter_element untouchable' id='cooking_methods_6' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Marinuoti</div><div class='filter_element_indicator' id='indicator_cooking_methods_6'></div></div>";
                $filters[6] = "<div class='filter_element untouchable' id='cooking_methods_7' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Mikrobangėje</div><div class='filter_element_indicator' id='indicator_cooking_methods_7'></div></div>";
                $filters[7] = "<div class='filter_element untouchable' id='cooking_methods_8' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Orkaitėje</div><div class='filter_element_indicator' id='indicator_cooking_methods_8'></div></div>";
                $filters[8] = "<div class='filter_element untouchable' id='cooking_methods_9' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Rauginti</div><div class='filter_element_indicator' id='indicator_cooking_methods_9'></div></div>";
                $filters[9] = "<div class='filter_element untouchable' id='cooking_methods_10' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Išrūkyti</div><div class='filter_element_indicator' id='indicator_cooking_methods_10'></div></div>";
                $filters[10] = "<div class='filter_element untouchable' id='cooking_methods_11' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Plakti</div><div class='filter_element_indicator' id='indicator_cooking_methods_11'></div></div>";
                $filters[11] = "<div class='filter_element untouchable' id='cooking_methods_12' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Sušaldyti</div><div class='filter_element_indicator' id='indicator_cooking_methods_12'></div></div>";
                $filters[12] = "<div class='filter_element untouchable' id='cooking_methods_13' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Ištroškinti</div><div class='filter_element_indicator' id='indicator_cooking_methods_13'></div></div>";
                $filters[13] = "<div class='filter_element untouchable' id='cooking_methods_14' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Išvirti</div><div class='filter_element_indicator' id='indicator_cooking_methods_14'></div></div>";
            break;

            case "ingredients_categories":
                $filters[0] = "<div class='filter_element untouchable' id='ingredients_category_1' onclick='filter_ingredients_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Žuvis</div></div>";
                $filters[1] = "<div class='filter_element untouchable' id='ingredients_category_2' onclick='filter_ingredients_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Mėsa</div></div>";
                $filters[2] = "<div class='filter_element untouchable' id='ingredients_category_3' onclick='filter_ingredients_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Pieno produktai</div></div>";
                $filters[3] = "<div class='filter_element untouchable' id='ingredients_category_4' onclick='filter_ingredients_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Grūdinė kultūra</div></div>";
                $filters[4] = "<div class='filter_element untouchable' id='ingredients_category_5' onclick='filter_ingredients_category(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/time.png');\"></div><div class='filter_element_text'>Riešutai</div></div>";
            break;
        }

        $response = array(
            'status' => 'good',
            'filters' => $filters,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function filter_ingredients_categoryAction(Request $request)
    {
        $request_data = $request->request;


        $ingredients_category = $request_data->get('filter_ingredients_category');
        //from category get all ingredients and form $filters array
        //look in current filters session to see indicaators (want, not_want)

        $filters = [];
        $filters[0] = "<div class='filter_element untouchable' id='ingredients_1' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/drinks.png');\"></div><div class='filter_element_text'>Lašiša</div><div class='filter_element_indicator' id='indicator_ingredients_1'></div></div>";
        $filters[1] = "<div class='filter_element untouchable' id='ingredients_2' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/pastries.png');\"></div><div class='filter_element_text'>Karpis</div><div class='filter_element_indicator' id='indicator_ingredients_2'></div></div>";
        $filters[2] = "<div class='filter_element untouchable' id='ingredients_3' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/deserts.png');\"></div><div class='filter_element_text'>Upėtakis</div><div class='filter_element_indicator' id='indicator_ingredients_3'></div></div>";
        $filters[3] = "<div class='filter_element untouchable' id='ingredients_4' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/second_dishes.png');\"></div><div class='filter_element_text'>Kardžuvė</div><div class='filter_element_indicator' id='indicator_ingredients_4'></div></div>";
        $filters[4] = "<div class='filter_element untouchable' id='ingredients_5' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/canned_meals.png');\"></div><div class='filter_element_text'>Ungurys</div><div class='filter_element_indicator' id='indicator_ingredients_5'></div></div>";


        $response = array(
            'status' => 'good',
            'filters' => $filters,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function loading_screen_textAction(Request $request)
    {
        $request_data = $request->request;
        //get random fact from database about food
        //create session

        $fact = "Bla bla";

        $response = array(
            'status' => 'good',
            'fact' => $fact,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function filter_show_selectedAction(Request $request)
    {
        $request_data = $request->request;
        //from current_filters_session get filters id and type, indicator and form $filters array
        $filters = [];
        $filters[0] = "<div class='filter_element untouchable filter_element_indicator_not_want' id='universities-1' onclick='filter_selected(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/types.png');\"></div><div class='filter_element_text'>Selected 1</div><div class='filter_element_delete' id='delete_universities-1' onclick='filter_delete(this.id)'></div><div class='filter_element_indicator_change' id='indicator_change_universities-1' onclick='filter_indicator_change(this.id)'></div><div class='filter_element_indicator_small'></div></div>";
        $filters[1] = "<div class='filter_element untouchable filter_element_indicator_want' id='universities-2' onclick='filter_selected(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/times.png');\"></div><div class='filter_element_text'>Selected want</div><div class='filter_element_delete' id='delete_universities-2' onclick='filter_delete(this.id)'></div><div class='filter_element_indicator_change' id='indicator_change_universities-2' onclick='filter_indicator_change(this.id)'></div><div class='filter_element_indicator_small'></div></div>";
        $filters[2] = "<div class='filter_element untouchable filter_element_indicator_not_want' id='universities-3' onclick='filter_selected(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/celebrations.png');\"></div><div class='filter_element_text'>Selected 3</div><div class='filter_element_delete' id='delete_universities-3' onclick='filter_delete(this.id)'></div><div class='filter_element_indicator_change' id='indicator_change_universities-3' onclick='filter_indicator_change(this.id)'></div><div class='filter_element_indicator_small'></div></div>";

        $response = array(
            'status' => 'good',
            'filters' => $filters,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function filter_personal_show_selectedAction(Request $request)
    {
        $request_data = $request->request;
        //from personal_filters_session get filters id and type, indicator and form $filters array
        $filters = [];
        $filters[0] = "<div class='filter_element untouchable filter_element_indicator_not_want' id='universities-1' onclick='filter_selected(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/types.png');\"></div><div class='filter_element_text'>Selected 1</div><div class='filter_element_delete' id='delete_universities-1' onclick='filter_delete(this.id)'></div><div class='filter_element_indicator_change' id='indicator_change_universities-1' onclick='filter_indicator_change(this.id)'></div><div class='filter_element_indicator_small'></div></div>";
        $filters[1] = "<div class='filter_element untouchable filter_element_indicator_want' id='universities-2' onclick='filter_selected(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/times.png');\"></div><div class='filter_element_text'>Selected want</div><div class='filter_element_delete' id='delete_universities-2' onclick='filter_delete(this.id)'></div><div class='filter_element_indicator_change' id='indicator_change_universities-2' onclick='filter_indicator_change(this.id)'></div><div class='filter_element_indicator_small'></div></div>";
        $filters[2] = "<div class='filter_element untouchable filter_element_indicator_not_want' id='universities-3' onclick='filter_selected(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/celebrations.png');\"></div><div class='filter_element_text'>Selected 3</div><div class='filter_element_delete' id='delete_universities-3' onclick='filter_delete(this.id)'></div><div class='filter_element_indicator_change' id='indicator_change_universities-3' onclick='filter_indicator_change(this.id)'></div><div class='filter_element_indicator_small'></div></div>";

        $response = array(
            'status' => 'good',
            'filters' => $filters,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function filter_indicator_changeAction(Request $request)
    {
        $request_data = $request->request;
        $filter_type = $request_data->get('filter_type');
        $filter_id = $request_data->get('filter_id');

        //change indicator type to vice-versa for filter in current filters session
        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function manipulate_filterAction(Request $request)
    {
        $request_data = $request->request;
        $filter_type = $request_data->get('filter_type');
        $filter_id = $request_data->get('filter_id');
        $filter_indicator = $request_data->get('filter_indicator');

        //change indicator in current filters session
        //want, not_want, none
        //none = delete

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

    public function filter_deleteAction(Request $request)
    {
        $request_data = $request->request;
        $filter_type = $request_data->get('filter_type');
        $filter_id = $request_data->get('filter_id');

        //delete filter from current filters session

        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function searchAction(Request $request)
    {
        $request_data = $request->request;

        $value = $request_data->get('search');
        //from search value get filters and recipes. do not show which are already selected in current filters session

        $search_data = [];
        $search_data[0] =
        "<div class='s_e search_item untouchable' id='search-ingredient-95'>".
            "<div class='s_e search_item_image' style=\"background-image:url('images/food (2).jpg')\"></div>".
            "<div class='s_e search_item_title'>Ananasas</div>".
            "<div class='s_e search_item_bottom_info'>Ingredientas</div>".
            "<div class='s_e filter_element_indicator indicator_search want' style='right: 25px;' onclick=\"filter_search_add('search-ingredient-95','want')\"></div>".
            "<div class='s_e filter_element_indicator indicator_search not_want' style='right: 3px;' onclick=\"filter_search_add('search-ingredient-95','not_want')\"></div>".
        "</div>";

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

        //from recipe_ID get all data about recipe and form recipe_data variable

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

        //from recipe_ID get all ingredients:id, imageUrl, title, amount, unit
        //from current shoppinglist and current filters session get indicator

        $ingredient_ID = '2';
        $ingredient_imageUrl = "/images/food (5).jpg";
        $ingredient_title = "Bananas";
        $ingredient_quantity = "5";
        $ingredient_unit = "vnt";
        $ingredient_indicator = "have"; // have, shoppinglist, undefined

        $ingredient =
        "<div class='ingredient untouchable' id='ingredient-$ingredient_ID' onclick=\"ingredient_selected('$ingredient_ID')\">
            <div class='ingredient_image' style='background-image:url(\"$ingredient_imageUrl\")'></div>
            <div class='ingredient_text'>$ingredient_title</div>
            <div class='ingredient_size'>$ingredient_quantity $ingredient_unit</div>
            <div class='ingredient_indicator ingredient_indicator_$ingredient_indicator' id='ingredient_indicator-$ingredient_ID'></div>
        </div>";

        $ingredients = $ingredient.$ingredient.$ingredient;

        $recipe_data =
        "<div id='sidebar_right_image' style='background-image:url(\"$imageUrl\");'></div>
            <div id='sidebar_right_title'>$title</div>
            <div id='sidebar_right_info'>
                <div class='sidebar_right_info_item untouchable $like_status' id='sidebar_right_like' onclick=\"recipe_like('$recipe_ID', this.id)\">$like_count</div>
                <div class='sidebar_right_info_item' id='sidebar_right_author'>$author</div>
                <div class='sidebar_right_info_item' id='sidebar_right_time'>$time</div>
                <div class='sidebar_right_info_item' id='sidebar_right_country'>$country</div>
                <div class='sidebar_right_info_item' id='sidebar_right_type'>$type</div>
                <div class='sidebar_right_info_item' id='sidebar_right_characteristics'>$properties</div>
                <div class='sidebar_right_info_item' id='sidebar_right_main_cooking_method'>$main_cooking_method</div>
                <div class='sidebar_right_info_item' id='sidebar_right_celebration'>$celebration</div>
            </div>
            <div id='sidebar_right_ingredients'>
                <div id='sidebar_right_ingredients_text'>Ingredientai</div>
                <div class='sidebar_right_ingredients_button' id='sidebar_right_ingredients_coop' onclick=\"show_top_layer('coop','$recipe_ID')\"></div>
                <div class='sidebar_right_ingredients_button' id='sidebar_right_ingredients_shoppinglist' onclick=\"add_to_shopping_list('$recipe_ID')\"></div>
            </div>
            <div id='divider' class='ingredients_divider'></div>
            <div id='sidebar_right_ingredients_zone'>$ingredients</div>
        </div>";

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

    public function admin_new_factAction(Request $request)
    {
        $request_data = $request->request;
        $fact_text = $request_data->get('fact_text');

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        //insert fact into DB
        $fact = new Fact();
        $fact->setText($fact_text);
        $em->persist($fact);
        $em->flush();


        //get fact data to show it

        ///*
        $repository = $this->getDoctrine()->getRepository('NFQAkademijaBaseBundle:Fact');
        $query = $repository->createQueryBuilder('f')
            ->select('f.id, f.text')
            ->setMaxResults(1)
            ->orderBy('f.id', 'DESC')
            ->getQuery();

        //*/
        /*
        $dql = "SELECT f FROM NFQAkademijaBaseBundle:Fact f ORDER BY f.id DESC LIMIT 1";
        $query = $em->createQuery($dql);
        */

        $latest_fact = $query->getSingleResult();
        $id = $latest_fact->getId();
        $text = $latest_fact->getText();

        $fact_data =
        "<div id='fact_$id'>
            <div class='input_title'>$id</div>
            <input type='text' class='new_recipe_input' placeholder='Faktas' value='$text'/>
            <div class='sub_save' onclick=\"save_fact('$id')\"></div>
            <div class='sub_delete' onclick=\"delete_fact('$id')\"></div>
        </div>";

        $response = array(
            'status' => 'good',
            'fact_data' => $id,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_delete_factAction(Request $request)
    {
        $request_data = $request->request;
        $fact_ID = $request_data->get('fact_ID');

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $fact = $em->getRepository('NFQAkademijaBaseBundle:Fact')->find($fact_ID);
        $em->remove($fact);
        $em->flush();

        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_save_factAction(Request $request)
    {
        $request_data = $request->request;
        $fact_ID = $request_data->get('fact_ID');
        $fact_text = $request_data->get('fact_text');

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $fact = $em->getRepository('NFQAkademijaBaseBundle:Fact')->find($fact_ID);
        $fact->setText($fact_text);
        $em->flush();

        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_new_locationAction(Request $request)
    {
        $request_data = $request->request;
        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_save_locationAction(Request $request)
    {
        $request_data = $request->request;
        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_delete_locationAction(Request $request)
    {
        $request_data = $request->request;
        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_new_commentAction(Request $request)
    {
        $request_data = $request->request;
        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_save_commentAction(Request $request)
    {
        $request_data = $request->request;
        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_delete_commentAction(Request $request)
    {
        $request_data = $request->request;
        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_new_filterAction(Request $request)
    {
        $request_data = $request->request;
        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_save_filterAction(Request $request)
    {
        $request_data = $request->request;
        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_delete_filterAction(Request $request)
    {
        $request_data = $request->request;
        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_new_ingredientAction(Request $request)
    {
        $request_data = $request->request;
        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_save_ingredientAction(Request $request)
    {
        $request_data = $request->request;
        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_delete_ingredientAction(Request $request)
    {
        $request_data = $request->request;
        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_new_userAction(Request $request)
    {
        $request_data = $request->request;
        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_save_userAction(Request $request)
    {
        $request_data = $request->request;
        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_delete_userAction(Request $request)
    {
        $request_data = $request->request;
        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_new_recipeAction(Request $request)
    {
        $request_data = $request->request;
        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_save_recipeAction(Request $request)
    {
        $request_data = $request->request;
        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_delete_recipeAction(Request $request)
    {
        $request_data = $request->request;
        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function admin_save_optionAction(Request $request)
    {
        $request_data = $request->request;
        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }
}
