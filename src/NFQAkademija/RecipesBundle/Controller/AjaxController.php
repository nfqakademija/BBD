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
}
