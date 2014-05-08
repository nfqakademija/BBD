<?php
namespace NFQAkademija\RecipesBundle\Controller;

use NFQAkademija\BaseBundle\Entity\Step;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class StepController extends Controller
{
    private function getMainForm($entity)
    {
        return $this->createFormBuilder($entity)
            ->add('description', 'text', array(
                'required' => true,
                'label' => 'Aprašymas',
                'trim' => true))
            ->add('recipe', 'entity', array(
                'mapped' => true,
                'class' => 'NFQAkademijaBaseBundle:Recipe',
                'required' => false,
                'label' => 'Receptas'))
            ->add('save', 'submit', array(
                'label' => "Išsaugoti"))
            ->getForm();
    }

    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $step = new Step();
        $form = $this->getMainForm($step);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $newData = $form->getData();

            $em->persist($newData);
            $em->flush();

            return $this->redirect($this->generateUrl('nfq_akademija_new_step'));
        }

        $entities = $this->getDoctrine()->getManager()->getRepository('NFQAkademijaBaseBundle:Step')->findAll();
        return $this->render('NFQAkademijaRecipesBundle:Step:new.html.twig', array(
            'form' => $form->createView(),
            'entities' => $entities,
        ));
    }
}