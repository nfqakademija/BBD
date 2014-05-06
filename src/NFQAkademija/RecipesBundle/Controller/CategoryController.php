<?php
namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use NFQAkademija\BaseBundle\Entity\Category;

class CategoryController extends Controller
{
    private function getMainForm($entity)
    {
        return $this->createFormBuilder($entity)
            ->add('name', 'text', array(
                'required' => true,
                'label' => 'Pavadinimas',
                'trim' => true))
            ->add('photo', 'text', array(
                'required' => true,
                'label' => 'Paveiksliuko adresas',
                'trim' => true))
            ->add('save', 'submit', array(
                'label' => "Išsaugoti"))
            ->getForm();
    }

    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $category = new Category();
        $form = $this->getMainForm($category);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $newData = $form->getData();

            $em->persist($newData);
            $em->flush();

            return $this->redirect($this->generateUrl('nfq_akademija_new_category'));
        }

        $entities = $this->getDoctrine()->getManager()->getRepository('NFQAkademijaBaseBundle:Category')->findAll();
        return $this->render('NFQAkademijaRecipesBundle:Category:new.html.twig', array(
            'form' => $form->createView(),
            'entities' => $entities,
        ));
    }
}