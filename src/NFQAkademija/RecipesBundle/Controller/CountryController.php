<?php
namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use NFQAkademija\BaseBundle\Entity\Country;

class CountryController extends Controller
{
    private function getMainForm($entity)
    {
        return $this->createFormBuilder($entity)
            ->add('name', 'text', array(
                'required' => true,
                'label' => 'Pavadinimas',
                'trim' => true))
            ->add('flag', 'text', array(
                'required' => true,
                'label' => 'Vėliavos adresas',
                'trim' => true))
            ->add('save', 'submit', array(
                'label' => "Išsaugoti"))
            ->getForm();
    }

    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $country = new Country();
        $form = $this->getMainForm($country);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $newData = $form->getData();

            $em->persist($newData);
            $em->flush();

            return $this->redirect($this->generateUrl('nfq_akademija_new_country'));
        }

        $entities = $this->getDoctrine()->getManager()->getRepository('NFQAkademijaBaseBundle:Country')->findAll();
        return $this->render('NFQAkademijaRecipesBundle:Country:new.html.twig', array(
            'form' => $form->createView(),
            'entities' => $entities,
        ));
    }
}