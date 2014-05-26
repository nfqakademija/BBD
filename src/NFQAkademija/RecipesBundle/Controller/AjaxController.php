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