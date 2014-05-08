<?php
namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use NFQAkademija\BaseBundle\Entity\CookingTime;

class CookingTimeController extends Controller
{
    private function getMainForm($entity)
    {
        return $this->createFormBuilder($entity)
            ->add('time', 'time', array(
                'required' => true,
                'label' => 'Laikas',
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

        $cookingTime = new CookingTime();
        $form = $this->getMainForm($cookingTime);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $newData = $form->getData();

            $em->persist($newData);
            $em->flush();

            return $this->redirect($this->generateUrl('nfq_akademija_new_cooking_time'));
        }

        $entities = $this->getDoctrine()->getManager()->getRepository('NFQAkademijaBaseBundle:CookingTime')->findAll();
        return $this->render('NFQAkademijaRecipesBundle:CookingTime:new.html.twig', array(
            'form' => $form->createView(),
            'entities' => $entities,
        ));
    }
}