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
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('NFQAkademijaRecipesBundle:Recipe')->findAll();

        return $this->render('NFQAkademijaRecipesBundle:Home:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Recipe entity
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('NFQAkademijaRecipesBundle:Recipe')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Receptas nerastas.');
        }

        return new Response('Rastas produktas: '.$entity->getRecipeName());
    }

    /*
     * Creates a new Recipe entity
     */
    public function newAction()
    {
        $recipe = new Recipe();
        $recipe->setRecipeName('Morkos be špinatų');
        $recipe->setRecipeType('vegetariška');
        $recipe->setRecipeIngredients('morka, česnakas');

        /*
        $form = $this->createFormBuilder($recipe)
            ->add('name', 'text', array('required' => true,
                'label' => 'Pavadinimas ',
                'trim' => true))
            ->add('type', 'text', array('required' => true,
                'label' => 'Tipas ',
                'trim' => true))
            ->add('ingredients', 'text', array('required' => true,
                'label' => 'Ingredientai ',
                'trim' => true))
            ->getForm();
        */

        $em = $this->getDoctrine()->getManager();
        $em->persist($recipe);
        $em->flush();

        return new Response('Created product id '.$recipe->getId());
    }

}
