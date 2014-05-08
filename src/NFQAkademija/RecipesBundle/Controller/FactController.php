<?php
namespace NFQAkademija\RecipesBundle\Controller;

use NFQAkademija\BaseBundle\Entity\Fact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use NFQAkademija\BaseBundle\Entity\Celebration;

class FactController extends Controller
{
    private function getMainForm($entity)
    {
        return $this->createFormBuilder($entity)
            ->add('text', 'text', array(
                'required' => true,
                'label' => 'Faktas',
                'trim' => true))
            ->add('save', 'submit', array(
                'label' => "Išsaugoti"))
            ->getForm();
    }

    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $fact = new Fact();
        $form = $this->getMainForm($fact);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $newData = $form->getData();

            $em->persist($newData);
            $em->flush();

            return $this->redirect($this->generateUrl('nfq_akademija_new_fact'));
        }

        $entities = $this->getDoctrine()->getManager()->getRepository('NFQAkademijaBaseBundle:Fact')->findAll();
        return $this->render('NFQAkademijaRecipesBundle:Fact:new.html.twig', array(
            'form' => $form->createView(),
            'entities' => $entities,
        ));
    }
}