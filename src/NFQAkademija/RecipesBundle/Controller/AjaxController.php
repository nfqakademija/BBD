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
        $properties = $request_data->get('new_recipe_properties');
        $ingredients = $request_data->get('new_recipe_ingredients');
        $steps = $request_data->get('new_recipe_steps');
        $celebrations = $request_data->get('new_recipe_celebrations');

        $response = array(
            'status' => 'good',
            'steps' => $ingredients,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }
}
