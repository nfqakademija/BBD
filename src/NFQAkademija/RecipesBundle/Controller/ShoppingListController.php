<?php

namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShoppingListController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user_ID = 4;
        $data = $em->getRepository("NFQAkademijaBaseBundle:Shoppinglist")->findBy(array("user" => $user_ID));
        $shoppinglist_items = [];
        foreach ($data as $dat){
            $product = $dat->getProduct();
            $id = $product->getId();
            $imageUrl = $product->getPhoto();
            $title = $product->getName();
            $shoppinglist_items[] = [
                "id" => $id,
                "imageUrl" => $imageUrl,
                "title" => $title,
            ];
        }

        return $this->render('NFQAkademijaRecipesBundle:ShoppingList:index.html.twig', array(
            'shoppinglist_items' => $shoppinglist_items
        ));
    }
}
