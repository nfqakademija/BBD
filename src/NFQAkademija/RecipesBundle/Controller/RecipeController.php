<?php
namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use NFQAkademija\BaseBundle\Entity\Recipe;

class RecipeController extends Controller
{

    private function getMainForm($entity)
    {
        return $this->createFormBuilder($entity)
            ->add('name', 'text', array(
                    'required'  => true,
                    'label'     => 'Pavadinimas',
                    'trim'      => true))
            ->add('description', 'textarea', array(
                    'required'  => true,
                    'label'     => 'Gaminimo aprašymas',
                    'trim'      => true))
            ->add('photo', 'text', array(
                    'required'  => true,
                    'label'     => 'Paveiksliuko adresas',
                    'trim'      => true))
            ->add('country', 'entity', array(
                    'mapped'    => true,
                    'class'     => 'NFQAkademijaBaseBundle:Country',
                    'required'  => false,
                    'label'     => 'Recepto kilmė'))
            ->add('save', 'submit', array('label' => "Išsaugoti"))
            ->getForm();
    }

    //TODO paveiksliukai
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
            $t = json_decode($products, true);



            $em->persist($newData);
            $em->flush();

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
