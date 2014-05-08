<?php
namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use NFQAkademija\BaseBundle\Entity\Location;

class LocationController extends Controller
{
    private function getMainForm($entity)
    {
        return $this->createFormBuilder($entity)
            ->add('title', 'text', array(
                'required' => true,
                'label' => 'Vieta',
                'trim' => true))
            ->add('type', 'text', array(
                'required' => true,
                'label' => 'Tipas',
                'trim' => true))
            ->add('latitude', 'number', array(
                'required' => true,
                'label' => 'Platuma',
                'trim' => true))
            ->add('longitude', 'number', array(
                'required' => true,
                'label' => 'Ilguma',
                'trim' => true))
            ->add('icon', 'text', array(
                'required' => true,
                'label' => 'Ikonos adresas',
                'trim' => true))
            ->add('about', 'text', array(
                'required' => true,
                'label' => 'Apie',
                'trim' => true))
            ->add('photo', 'text', array(
                'required' => true,
                'label' => 'Nuotrauka',
                'trim' => true))
            ->add('save', 'submit', array(
                'label' => "Išsaugoti"))
            ->getForm();
    }

    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $location = new Location();
        $form = $this->getMainForm($location);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $newData = $form->getData();

            $em->persist($newData);
            $em->flush();

            return $this->redirect($this->generateUrl('nfq_akademija_new_location'));
        }

        $entities = $this->getDoctrine()->getManager()->getRepository('NFQAkademijaBaseBundle:Location')->findAll();
        return $this->render('NFQAkademijaRecipesBundle:Location:new.html.twig', array(
            'form' => $form->createView(),
            'entities' => $entities,
        ));
    }
}