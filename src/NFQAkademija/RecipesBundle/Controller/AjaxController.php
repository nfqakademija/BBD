<?php

namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class AjaxController extends Controller
{
    public function new_recipeAction(Request $request)
    {
        $request_data = $request->request;

        $title = $request_data->get('new_recipe_title');
        $about = $request_data->get('new_recipe_about');
        $image = $request_data->get('new_recipe_image');
        $time = $request_data->get('new_recipe_time');
        $country = $request_data->get('new_recipe_country');
        $main_cooking_method = $request_data->get('new_recipe_main_cooking_method');
        $properties = json_decode($request_data->get('new_recipe_properties'));
        $ingredients = json_decode(json_decode($request_data->get('new_recipe_ingredients')));
        $steps = json_decode($request_data->get('new_recipe_steps'));
        $celebrations = json_decode($request_data->get('new_recipe_celebrations'));

        //MYSQL INSERT


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

        //MYSQL SELECT
        //get recipe_ID, image_url, title
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

    public function append_recipesAction(Request $request)
    {
        $request_data = $request->request;


        //MYSQL SELECT
        //get recipe_ID, image_url, title from filters
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

    public function append_productsAction(Request $request)
    {
        $request_data = $request->request;


        //MYSQL SELECT
        //get product_ID, image_url, title //akcijos
        //kolkas random produktai - ingredientai

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
        //MYSQL SELECT
        //get shoppinglist


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
        //MYSQL SELECT
        //get filter start
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
        //MYSQL SELECT
        //get filter start
        $category = $request_data->get('filter_category');
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
        //MYSQL SELECT
        $ingredients_category = $request_data->get('filter_ingredients_category');
        $filters = [];
        switch($ingredients_category) {
            case "ingredients_category_1":
                $filters[0] = "<div class='filter_element untouchable' id='ingredients_1' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/drinks.png');\"></div><div class='filter_element_text'>Lašiša</div><div class='filter_element_indicator' id='indicator_ingredients_1'></div></div>";
                $filters[1] = "<div class='filter_element untouchable' id='ingredients_2' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/pastries.png');\"></div><div class='filter_element_text'>Karpis</div><div class='filter_element_indicator' id='indicator_ingredients_2'></div></div>";
                $filters[2] = "<div class='filter_element untouchable' id='ingredients_3' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/deserts.png');\"></div><div class='filter_element_text'>Upėtakis</div><div class='filter_element_indicator' id='indicator_ingredients_3'></div></div>";
                $filters[3] = "<div class='filter_element untouchable' id='ingredients_4' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/second_dishes.png');\"></div><div class='filter_element_text'>Kardžuvė</div><div class='filter_element_indicator' id='indicator_ingredients_4'></div></div>";
                $filters[4] = "<div class='filter_element untouchable' id='ingredients_5' onclick='manipulate_filter(this.id)'><div class='filter_element_image' style=\"background-image:url('/images/canned_meals.png');\"></div><div class='filter_element_text'>Ungurys</div><div class='filter_element_indicator' id='indicator_ingredients_5'></div></div>";
            break;
        }

        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function loading_screen_textAction(Request $request)
    {
        $request_data = $request->request;
        //MYSQL SELECT

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
        //MYSQL SELECT
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
        //MYSQL SELECT
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
        //MYSQL SELECT

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
        //MYSQL SELECT

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
        //MYSQL SELECT
        $id = $request_data->get("shoppinglist_add_id");
        $title = $request_data->get("shoppinglist_add_title");

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
        //MYSQL SELECT
        $id = $request_data->get("shoppinglist_delete");


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
        //MYSQL SELECT

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
        //MYSQL SELECT

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
        //MYSQL SELECT
        $value = $request_data->get('search');

        $search_data = [];
        $search_data[0] =
        "<div class='s_e search_item untouchable' id='search-ingredient-95'>" +
            "<div class='s_e search_item_image' style=\"background-image:url('images/food (2).jpg')\"></div>" +
            "<div class='s_e search_item_title'>Ananasas</div>" +
            "<div class='s_e search_item_bottom_info'>Ingredientas</div>" +
            "<div class='s_e filter_element_indicator indicator_search want' style='right: 25px;' onclick=\"filter_search_add('search-ingredient-95','want')\"></div>" +
            "<div class='s_e filter_element_indicator indicator_search not_want' style='right: 3px;' onclick=\"filter_search_add('search-ingredient-95','not_want')\"></div>" +
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
        //MYSQL SELECT
        $value = $request_data->get('search_shoppinglist');

        $search_data = [];
        $search_data[0] =
            "<div class='s_e search_item untouchable' id='shoppinglist-ingredient-95' onclick='shoppinglist_add(this.id)'>"+
                "<div class='s_e search_item_image' style=\"background-image:url('images/food (2).jpg')\"></div>"+
                "<div class='s_e search_item_title'>Ananasas</div>"+
                "<div class='s_e search_item_bottom_info'>Ingredientas</div>"+
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
        //MYSQL SELECT
        $value = $request_data->get('search_places');

        $search_data = [];
        $search_data[0] =
            "<div class='s_e search_item untouchable' id='search-maxima' onclick=\"show_nearest('maxima');\">" +
                "<div class='s_e search_item_image' style=\"background-image:url('/images/maxima.png')\"></div>" +
                "<div class='s_e search_item_title'>Maxima</div>" +
                "<div class='s_e search_item_bottom_info'>Parduotuvė</div>" +
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
        //MYSQL SELECT
        $recipe_ID = $request_data->get('recipe_right_sidebar_ID');

        //from ajax with recipe ID get
        /*
        var image;
        var title;
        var country;
        var time;
        var rating;
        var main_cooking_method;
        var type;
        var characteristics; //array of them
        var celebration; //array of them or empty
        var ingredients; //array of them
        */

        $response = array(
            'status' => 'good',

        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function user_cookingAction(Request $request)
    {
        $request_data = $request->request;
        //MYSQL SELECT
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
        //MYSQL SELECT
        $ingredient_ID = $request_data->get('ingredient_ID');
        //add to users shoppinglist ingredient and quantity

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
        //MYSQL SELECT
        $recipe_ID = $request_data->get('recipe_ID');
        //add to users shoppinglist ingredient and quantity

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
        //MYSQL SELECT
        $ingredient_ID = $request_data->get('ingredient_ID');

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
        //MYSQL SELECT
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
        //MYSQL SELECT

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
        //MYSQL SELECT

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
        //MYSQL SELECT

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
        //MYSQL SELECT

        $response = array(
            'status' => 'good',

        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }
}



