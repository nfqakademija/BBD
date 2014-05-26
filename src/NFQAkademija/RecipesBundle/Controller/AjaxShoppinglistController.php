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



class AjaxShoppinglistController extends Controller
{
    public function add_to_shoppinglistAction(Request $request)
    {
        $request_data = $request->request;
        $product_ID = $request_data->get("product_ID");
        $em = $this->getDoctrine()->getManager();
        $user_ID = 4;

        $exists = $em->getRepository("NFQAkademijaBaseBundle:Shoppinglist")->find(array("user" => $user_ID, "product" => $product_ID));
        if(!$exists) {
            $data = new Shoppinglist();
            $user = $em->getRepository("NFQAkademijaBaseBundle:User")->find($user_ID);
            $product = $em->getRepository("NFQAkademijaBaseBundle:Product")->find($product_ID);
            $data->setUser($user);
            $data->setProduct($product);
            $data->setQuantity(1);
            $em->persist($data);
            $em->flush();
            $status = 'good';
        }else{
            $status = 'bad';
        }

        $product_data = $this->getDoctrine()->getRepository('NFQAkademijaBaseBundle:Product')->find($product_ID);
        $data = $this->render('NFQAkademijaRecipesBundle:AjaxViews:ShoppinglistItem.html.twig',
            array(
                'id' => $product_data->getId(),
                'title' => $product_data->getName(),
                'imageUrl' => $product_data->getPhoto(),
            ));
        $data = $data->getContent();

        $response = array(
            'status' => $status,
            'shoppinglist_item' => $data
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function add_to_shoppinglist_from_recipeAction(Request $request)
    {
        $request_data = $request->request;
        $recipe_ID = $request_data->get("recipe_ID");
        $em = $this->getDoctrine()->getManager();
        $user_ID = 4;
        $ingredients_data = $em->getRepository("NFQAkademijaBaseBundle:RecipeProduct")->findBy(array('recipe' => $recipe_ID));
        $product_ids = [];
        foreach($ingredients_data as $ingredient){
            $product = $ingredient->getProduct();
            $product_ids[] = $product->getId();
        }

        foreach($product_ids as $product_ID){
            $exists = $em->getRepository("NFQAkademijaBaseBundle:Shoppinglist")->find(array("user" => $user_ID, "product" => $product_ID));
            if(!$exists) {
                $data = new Shoppinglist();
                $user = $em->getRepository("NFQAkademijaBaseBundle:User")->find($user_ID);
                $product = $em->getRepository("NFQAkademijaBaseBundle:Product")->find($product_ID);
                $data->setUser($user);
                $data->setProduct($product);
                $data->setQuantity(1);
                $em->persist($data);
            }
        }

        $em->flush();
        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }

    public function remove_from_shoppinglistAction(Request $request)
    {
        $request_data = $request->request;
        $product_ID = $request_data->get("product_ID");
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $user_ID = 4;

        $exists = $em->getRepository("NFQAkademijaBaseBundle:Shoppinglist")->find(array("user" => $user_ID, "product" => $product_ID));
        if($exists) {
            $em->remove($exists);
            $em->flush();
        }

        $response = array(
            'status' => 'good',
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }
}