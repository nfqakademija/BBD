<?php

namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use NFQAkademija\RecipesBundle\Entity\Recipe;

class HomeController extends Controller
{
    /*
     * Lists all Recipe entities
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('NFQAkademijaRecipesBundle:Recipe')->findAll();

        $recipe = new Recipe();
        $form = $this->createFormBuilder($recipe)
            ->add('RecipeName', 'text', array('required' => false,
                'label' => 'Pavadinimas ',
                'trim' => true)) // minimum 3 charakteriai?
            //->add('RecipeType', 'text', array('required' => false,
            //    'label' => 'Tipas ', // checkboxes?
            //    'trim' => true))
            ->add('RecipeIngredients', 'text', array('required' => false,
                'label' => 'Ingredientai ',
                'trim' => true))
            ->add('Ieškoti', 'submit')
            ->getForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $searchKey = $form->get('RecipeName')->getData();
            //$searchKey2 = $form->get('RecipeType')->getData();
            $searchKey3 = $form->get('RecipeIngredients')->getData();

            $session = $request->getSession();
            if(strpos($searchKey3,',') !== false) {
                $productArray = array_map('strrev', explode(',', strrev($searchKey3)));
                $session->set('shoppingList', $productArray);
            }
            else {
                $session->set('shoppingList', array($searchKey3));
            }

            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery(
                'SELECT p FROM NFQAkademijaRecipesBundle:Recipe p
                WHERE p.recipeName LIKE :searchKey
                ORDER BY p.recipeName ASC');
            $query->setParameter('searchKey', $searchKey.'%');
            //$query->setParameter('searchKey2', $searchKey2); // AND p.recipeType = :searchKey2

            $recipes = $query->getResult();

            return $this->render('NFQAkademijaRecipesBundle:Home:found.html.twig', array(
                'recipes' => $recipes,
            ));
        }

        return $this->render('NFQAkademijaRecipesBundle:Home:index.html.twig', array(
            'entities' => $entities,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Recipe entity
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('NFQAkademijaRecipesBundle:Recipe')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Receptas nerastas.');
        }

        return new Response('Rastas receptas: '.$entity->getRecipeName());
    }

    /*
     * Creates a new Recipe entity
     */
    public function newAction(Request $request)
    {
        $recipe = new Recipe();

        $form = $this->createFormBuilder($recipe)
            ->add('RecipeName', 'text', array('required' => true,
                'label' => 'Pavadinimas ',
                'trim' => true))
            ->add('RecipeType', 'text', array('required' => true,
                'label' => 'Tipas ',
                'trim' => true))
            ->add('RecipeIngredients', 'text', array('required' => true,
                'label' => 'Ingredientai ',
                'trim' => true))
            ->add('Sukurti', 'submit')
            ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($recipe);
            $em->flush();
            return new Response('Created product id '.$recipe->getId());
        }

        return $this->render('NFQAkademijaRecipesBundle:Home:create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /*
     * Deletes a Recipe entity
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('NFQAkademijaRecipesBundle:Recipe')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Receptas nerastas.');
        }
        $em->remove($entity);
        $em->flush();
        return new Response('Ištrintas receptas: '.$entity->getRecipeName());
    }

    /*
     * Shows user's profile page or FB login form
     */
    public function profileAction()
    {
        //$user = $this->getUser();
        $user = 'Mr.Fake';
        return $this->render('NFQAkademijaRecipesBundle:Profile:index.html.twig', array(
            'user' => $user,
        ));
    }

    /*
     * Shows user's shopping list
     */
    public function shoppingListAction(Request $request)
    {
        $session = $request->getSession();
        $products = $session->get('shoppingList');
        return $this->render('NFQAkademijaRecipesBundle:ShoppingList:index.html.twig', array(
            'products' => implode(', ',$products),
        ));
    }
}
