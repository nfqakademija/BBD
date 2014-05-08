<?php
namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use NFQAkademija\BaseBundle\Entity\Type;

class TypeController extends Controller
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

$type = new Type();
$form = $this->getMainForm($type);
$form->handleRequest($request);

if ($form->isValid()) {
$newData = $form->getData();

$em->persist($newData);
$em->flush();

return $this->redirect($this->generateUrl('nfq_akademija_new_type'));
}

$entities = $this->getDoctrine()->getManager()->getRepository('NFQAkademijaBaseBundle:Type')->findAll();
return $this->render('NFQAkademijaRecipesBundle:Type:new.html.twig', array(
'form' => $form->createView(),
'entities' => $entities,
));
}
}