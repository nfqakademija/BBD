<?php
namespace NFQAkademija\RecipesBundle\Controller;

use NFQAkademija\BaseBundle\Entity\MainCookingMethod;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MainCookingMethodController extends Controller
{
    private function getMainForm($entity)
    {
        return $this->createFormBuilder($entity)
            ->add('name', 'text', array(
                'required' => true,
                'label' => 'Pavadinimas',
                'trim' => true))
            ->add('icon', 'text', array(
                'required' => true,
                'label' => 'Ikonos adresas',
                'trim' => true))
            ->add('save', 'submit', array(
                'label' => "Išsaugoti"))
            ->getForm();
    }

    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $method = new MainCookingMethod();
        $form = $this->getMainForm($method);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $newData = $form->getData();

            $em->persist($newData);
            $em->flush();

            return $this->redirect($this->generateUrl('nfq_akademija_new_method'));
        }

        $entities = $this->getDoctrine()->getManager()->getRepository('NFQAkademijaBaseBundle:MainCookingMethod')->findAll();
        return $this->render('NFQAkademijaRecipesBundle:Type:new.html.twig', array(
            'form' => $form->createView(),
            'entities' => $entities,
        ));
    }
}