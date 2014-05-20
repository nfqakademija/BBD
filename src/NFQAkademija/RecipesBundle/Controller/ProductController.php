<?php
namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use NFQAkademija\BaseBundle\Entity\Product;
use NFQAkademija\BaseBundle\Entity\Category;

class ProductController extends Controller
{
    private function getMainForm($entity)
    {
        return $this->createFormBuilder($entity)
            ->add('name', 'text', array(
                'required' => true,
                'label' => 'Pavadinimas',
                'trim' => true))
            ->add('category', 'entity', array(
                'mapped' => true,
                'class' => 'NFQAkademijaBaseBundle:Category',
                'required' => false,
                'label' => 'Kategorija'))
            ->add('unit', 'entity', array(
                'mapped' => true,
                'class' => 'NFQAkademijaBaseBundle:Unit',
                'required' => false,
                'label' => 'Vienetai'))
            ->add('photo', 'text', array(
                'required' => false,
                'label' => 'Paveiksliuko adresas',
                'trim' => true))
            ->add('save', 'submit', array(
                'label' => "Išsaugoti"))
            ->getForm();
    }

    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $product = new Product();
        $form = $this->getMainForm($product);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $newData = $form->getData();

            $em->persist($newData);
            $em->flush();

            return $this->redirect($this->generateUrl('nfq_akademija_new_product'));
        }

        $entities = $this->getDoctrine()->getManager()->getRepository('NFQAkademijaBaseBundle:Product')->findAll();
        return $this->render('NFQAkademijaRecipesBundle:Product:new.html.twig', array(
            'form' => $form->createView(),
            'entities' => $entities,
        ));
    }
}