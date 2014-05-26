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



class AjaxSearchController extends Controller
{
    public function searchAction(Request $request)
    {
        $request_data = $request->request;
        $value = $request_data->get('search');
        $good_data = [];
        $search_zones = ["Celebration", "CookingTime", "Country", "MainCookingMethod", "Product", "Property", "Recipe", "Type"];

        foreach($search_zones as $zone){
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
                default: $info = "Rezultatas";
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

        $search_data = [];
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
        $search_data = [];

        $em = $this->getDoctrine()->getManager();
        $user_ID = 4;
        $data = $em->getRepository("NFQAkademijaBaseBundle:Shoppinglist")->findBy(array("user" => $user_ID));
        $already_in_shoppinglist_ids = [];
        foreach ($data as $dat){
            $product = $dat->getProduct();
            $id = $product->getId();
            $already_in_shoppinglist_ids[] = $id;
        }

        $repository = $this->getDoctrine()->getRepository('NFQAkademijaBaseBundle:Product');
        $query = $repository->createQueryBuilder('f')
            ->select('f.id, f.name, f.photo')
            ->where('f.name LIKE :name')
            ->andWhere('f.id NOT IN (:already_in_shoppinglist_ids)')
            ->setParameter('name', $value.'%')
            ->setParameter('already_in_shoppinglist_ids', $already_in_shoppinglist_ids)
            ->orderBy('f.name', 'ASC')
            ->getQuery();
        $search_data = $query->getResult();

        $products = [];
        foreach($search_data as $data){
            $single_product = $this->render('NFQAkademijaRecipesBundle:AjaxViews:SearchProduct.html.twig',
                array(
                    'id' => $data["id"],
                    'title' => $data["name"],
                    'imageUrl' => $data["photo"],
                    'category' => "Produktas"
                ));
            $products[] = $single_product->getContent();
        }

        $response = array(
            'status' => 'good',
            'search_data' => $products,
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
        //get title, imageUrl, brand, type

        $search_data = [];
        $repository = $this->getDoctrine()->getRepository('NFQAkademijaBaseBundle:Location');
        $query = $repository->createQueryBuilder('f')
            ->select('f.brand, f.title, f.icon, f.type')
            ->where('f.title LIKE :title')
            ->setParameter('title', $value.'%')
            ->orderBy('f.title', 'ASC')
            ->groupBy('f.brand')
            ->getQuery();
        $search_data = $query->getResult();

        $places = [];
        foreach($search_data as $data){
            $single_place = $this->render('NFQAkademijaRecipesBundle:AjaxViews:SearchPlace.html.twig',
                array(
                    'brand' => $data["brand"],
                    'title' => $data["title"],
                    'imageUrl' => $data["icon"],
                    'type' => $data["type"],
            ));
        $places[] = $single_place->getContent();
        }


        $response = array(
            'status' => 'good',
            'search_data' => $places,
        );

        $jsonResponse = new Response(json_encode($response));
        $jsonResponse->headers->set('Content-Type', 'application/json; Charset=UTF-8');
        return $jsonResponse;
    }
}