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



class AjaxSocialController extends Controller
{
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
        $user_ID = 4;
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("NFQAkademijaBaseBundle:User")->find($user_ID);
        $recipe = $em->getRepository("NFQAkademijaBaseBundle:Recipe")->find($recipe_ID);
        //$image_url = $user->getPhoto();
        $image_url = "https://fbcdn-profile-a.akamaihd.net/hprofile-ak-ash3/t1.0-1/c0.64.621.621/s160x160/995138_552905818091967_731332747_n.jpg";


        $date = new \DateTime("now");

        $data = new Comment();

        $data->setUser($user);
        $data->setRecipe($recipe);
        $data->setDate($date);
        $data->setText($comment);
        $em->persist($data);
        $em->flush();

        $comment_html = $this->render('NFQAkademijaRecipesBundle:AjaxViews:Comment.html.twig',
            array(
                'text' => $comment,
                'imageUrl' => $image_url,
            ));
        $comment_html = $comment_html->getContent();

        $response = array(
            'status' => 'good',
            'comment_html' => $comment_html,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }
}