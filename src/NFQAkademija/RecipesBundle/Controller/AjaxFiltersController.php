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



class AjaxFiltersController extends Controller
{
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
}