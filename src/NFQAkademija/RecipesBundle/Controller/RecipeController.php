<?php
namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use NFQAkademija\BaseBundle\Entity\Recipe;
use NFQAkademija\BaseBundle\Entity\RecipeProduct;

class RecipeController extends Controller
{
    private function getMainForm($entity)
    {
        return $this->createFormBuilder($entity)
            ->add('name', 'text', array(
                'required' => true,
                'label' => 'Pavadinimas',
                'trim' => true))
            ->add('properties', 'entity', array(
                'mapped' => true,
                'class' => 'NFQAkademijaBaseBundle:Property',
                'property' => 'name',
                'required' => false,
                'label' => 'Ypatybės:',
                'expanded' => true,
                'multiple' => true))
            ->add('description', 'text', array(
                'required' => true,
                'label' => 'Gaminimo aprašymas',
                'trim' => true))
            ->add('photo', 'text', array(
                'required' => true,
                'label' => 'Paveiksliuko adresas',
                'trim' => true))
            ->add('country', 'entity', array(
                'mapped' => true,
                'class' => 'NFQAkademijaBaseBundle:Country',
                'required' => false,
                'label' => 'Recepto kilmė'))
            ->add('mainCookingMethod', 'entity', array(
                'mapped' => true,
                'class' => 'NFQAkademijaBaseBundle:MainCookingMethod',
                'required' => false,
                'label' => 'Gaminimo būdas'))
            ->add('type', 'entity', array(
                'mapped' => true,
                'class' => 'NFQAkademijaBaseBundle:Type',
                'required' => false,
                'label' => 'Tipas'))
            ->add('celebration', 'entity', array(
                'mapped' => true,
                'class' => 'NFQAkademijaBaseBundle:Celebration',
                'required' => false,
                'label' => 'Šventė'))
            ->add('cookingTime', 'entity', array(
                'mapped' => true,
                'class' => 'NFQAkademijaBaseBundle:CookingTime',
                'required' => false,
                'label' => 'Gaminimo laikas'))
            ->add('save', 'submit', array(
                'label' => "Išsaugoti"))
            ->getForm();
    }

    //TODO produktu issaugojimas, kai formoje erorai,
    //TODO produktu dubliavimo draudimas, paveiksliukai
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('NFQAkademijaBaseBundle:Product')->findAll();

        $recipe = new Recipe();
        $form = $this->getMainForm($recipe);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $newData = $form->getData();
            $products = $request->request->get('products');
            $productsData = json_decode($products, true);

            $em->persist($newData);
            $em->flush();

            foreach($productsData as $product) {
                $recipeProduct = new RecipeProduct();
                $recipeProduct->setRecipe($recipe);
                $recipeProduct->setQuantity($product['quantity']);
                $productEntity = $em->getRepository('NFQAkademijaBaseBundle:Product')->findOneById($product['item']);
                $recipeProduct->setProduct($productEntity);
                $em->persist($recipeProduct);
                $em->flush();
            }
            return $this->redirect($this->generateUrl('nfq_akademija_new_recipe'));
        }

        $entities = $this->getDoctrine()->getManager()->getRepository('NFQAkademijaBaseBundle:Recipe')->findAll();
        return $this->render('NFQAkademijaRecipesBundle:Recipe:new.html.twig', array(
            'form' => $form->createView(),
            'entities' => $entities,
            'products' => $products
        ));
    }
}