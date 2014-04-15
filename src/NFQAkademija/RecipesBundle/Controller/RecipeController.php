<?php

namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

use NFQAkademija\BaseBundle\Entity\Recipe;
use NFQAkademija\BaseBundle\Entity\Country;
use NFQAkademija\BaseBundle\Entity\Property;
use NFQAkademija\BaseBundle\Entity\Product;
use NFQAkademija\BaseBundle\Entity\Category;
use NFQAkademija\BaseBundle\Entity\RecipeProduct;

class RecipeController extends Controller
{
    /**
     * Return a ajax response
     */
    public function addProductToRecipeAction(){
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();

        $productQuantity=$request->request->get('formQuantity');
        $productName=$request->request->get('formName');
        if($productName!="" && $productQuantity!="" &&
            $product = $em->getRepository('NFQAkademijaBaseBundle:Product')->findOneByName($productName)) {

            $session = $request->getSession();
            $quantityArray = $session->get('recipeQuantities');
            $productArray = $session->get('recipeProducts');
                array_push($quantityArray, $productQuantity);
                array_push($productArray, $productName);
            $session->set('recipeQuantities', $quantityArray);
            $session->set('recipeProducts', $productArray);

            //$message='Produkto id: '.$product->getId().', kiekis: '.$productQuantity;
            $message = implode(', ', $productArray);
            $return=array("responseCode"=>200,  "greeting"=>$message);
        } else {
            $return=array("responseCode"=>400, "greeting"=>"Produktas nerastas");
        }

        $return=json_encode($return);//json encode the array
        return new Response($return,200,array('Content-Type'=>'application/json'));
    }

    //TODO ingredientu pridejimas, paveiksliukai
    public function newAction()
    {
        $request = $this->get('request');

        $quantityArray = array();
        $productArray = array();
        $session = $request->getSession();
        $session->set('recipeQuantities', $quantityArray);
        $session->set('recipeProducts', $productArray);

//        $defaultData = array('message' => 'Recepto produktai');
//        $productForm = $this->createFormBuilder($defaultData)
//            ->add('quantity', 'text', array(
//                'constraints' => array(
//                    new NotBlank(),
//                    new Length(array('min' => 3, 'max' => 10))),
//                'required'  => true,
//                'label'     => 'Produkto kiekis',
//                'trim'      => true))
//            ->add('name', 'text', array(
//                'required'  => true,
//                'label'     => 'Produktas',
//                'trim'      => true))
//            ->add('add', 'submit', array(
//                'label' => '+'))
//            ->getForm();

        $recipeForm = new Recipe();
        $form = $this->createFormBuilder($recipeForm)
            ->add('name', 'text', array(
                'required'  => true,
                'label'     => 'Pavadinimas',
                'trim'      => true))
            ->add('description', 'textarea', array(
                'required'  => true,
                'label'     => 'Gaminimo aprašymas',
                'trim'      => true))
            ->add('rating', 'hidden', array( // send hidden 0
                'data'      => '0'))
            ->add('raters', 'hidden', array( // send hidden 0
                'data'      => '0'))
            ->add('photo', 'text', array(
                'required'  => true,
                'label'     => 'Paveiksliuko adresas',
                'trim'      => true))
            ->add('cookingDuration', 'choice', array(
                'choices'   => $recipeForm->getCookingDurations(),
                'required'  => true,
                'label'     => 'Gaminimo trukmė'))
            ->add('properties', 'entity', array(
                'mapped'    => true,
                'class'     => 'NFQAkademijaBaseBundle:Property',
                'property'  => 'name',
                'required'  => false,
                'label'     => 'Ypatybės:',
                'expanded'  => true,
                'multiple'  => true))
            ->add('country', 'entity', array(
                'mapped'    => true,
                'class'     => 'NFQAkademijaBaseBundle:Country',
                'property'  => 'Name',
                'required'  => false,
                'label'     => 'Recepto kilmė'))
            ->add('Išsaugoti', 'submit')
            ->getForm();
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        if ($form->isValid()) {
//            $em->persist($recipeForm);
//            $em->flush();

            // add recipe products to recipeProduct entity
            $dummyArray = array();
            $session2 = $request->getSession();
            $quantArray = $session2->get('recipeQuantities');
            $prodArray = $session2->get('recipeProducts');
            $recipeId = $recipeForm->getId();
//            for ($i=0; $i<sizeof($quantityArray); $i++) {
// //               $recipeProduct = new RecipeProduct();
//
// //               $recipeProduct->setRecipe($recipeId);
////                $recipeProduct->setQuantity($quantityArray[i]);
//                $productId = $em->getRepository('NFQAkademijaBaseBundle:Product')->findOneByName($productArray[$i]);
////                $recipeProduct->setProduct($productId);
//
//                array_push($dummyArray, $recipeId, $quantityArray[$i], $productId);
////                $em = $this->getDoctrine()->getManager();
////                $em->persist($recipeProduct);
////                $em->flush();
//            }
            //return new Response('Naujo recepto id: '.$recipeForm->getId());
            return new Response('msg: '.implode(', ', $quantArray));
        } else {
            $entities = $em->getRepository('NFQAkademijaBaseBundle:Recipe')->findAll();
            return $this->render('NFQAkademijaRecipesBundle:Recipe:new.html.twig', array(
                'form' => $form->createView(),
//                'productform' => $productForm->createView(),
                'entities' => $entities,
            ));
        }

//        $ent = $em->getRepository('NFQAkademijaBaseBundle:Recipe')->find('32');
////            $result = $ent->getProperties(); //gaunama enticiu kolekcija
//        return new Response('Atgautas atributas: '.$ent->getCookingDuration()); //$result[0]->getName()

//        $entity = $em->getRepository('NFQAkademijaBaseBundle:Recipe')->find('33');
//        if (!$entity) {
//            throw $this->createNotFoundException('Receptas nerastas!');
//        }
//        $em->remove($entity);
//        $em->flush();
//        return new Response('Ištrinta šalis: '.$entity->getName());
    }

    public function newCountryAction() {
        $request = $this->get('request');

        $country = new Country();
        $form = $this->createFormBuilder($country)
            ->add('Name', 'text', array('required' => true,
                'label' => 'Pavadinimas ',
                'trim' => true))
            ->add('Flag', 'text', array('required' => true,
                'label' => 'Vėliavos paveiksliukas',
                'trim' => true))
            ->add('Sukurti', 'submit')
            ->getForm();

        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isValid()) {
            $em->persist($country);
            $em->flush();
            return new Response('Naujos šalies id: '.$country->getId());
        } else {
            $entities = $em->getRepository('NFQAkademijaBaseBundle:Country')->findAll();
            return $this->render('NFQAkademijaRecipesBundle:Recipe:newCountry.html.twig', array(
                'form' => $form->createView(),
                'entities' => $entities,
            ));
        }
//        $em = $this->getDoctrine()->getManager();
//        $entity = $em->getRepository('NFQAkademijaBaseBundle:Country')->find('1');
//        if (!$entity) {
//            throw $this->createNotFoundException('Šalis nerasta!');
//        }
//        $em->remove($entity);
//        $em->flush();
//        return new Response('Ištrinta šalis: '.$entity->getName());
    }

    public function newPropertyAction() {
        $request = $this->get('request');

        $property = new Property();
        $form = $this->createFormBuilder($property)
            ->add('name', 'text', array('required' => true,
                'label' => 'Pavadinimas ',
                'trim' => true))
            ->add('photo', 'text', array('required' => true,
                'label' => 'Ypatybės paveiksliukas',
                'trim' => true))
            ->add('Sukurti', 'submit')
            ->getForm();

        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isValid()) {
            $em->persist($property);
            $em->flush();
            return new Response('Naujos ypatybės id: '.$property->getId());
        } else {
            $entities = $em->getRepository('NFQAkademijaBaseBundle:Property')->findAll();
            return $this->render('NFQAkademijaRecipesBundle:Recipe:newProperty.html.twig', array(
                'form' => $form->createView(),
                'entities' => $entities,
            ));
        }
    }

    public function newCategoryAction() {
        $request = $this->get('request');

        $category = new Category();
        $form = $this->createFormBuilder($category)
            ->add('Name', 'text', array('required' => true,
                'label' => 'Pavadinimas ',
                'trim' => true))
            ->add('Photo', 'text', array('required' => true,
                'label' => 'Kategorijos paveiksliukas',
                'trim' => true))
            ->add('Sukurti', 'submit')
            ->getForm();

        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isValid()) {
            $em->persist($category);
            $em->flush();
            return new Response('Naujos kategorijos id: '.$category->getId());
        } else {
            $entities = $em->getRepository('NFQAkademijaBaseBundle:Category')->findAll();
            return $this->render('NFQAkademijaRecipesBundle:Recipe:newCategory.html.twig', array(
                'form' => $form->createView(),
                'entities' => $entities,
            ));
        }
    }

    public function newProductAction() {
        $request = $this->get('request');

        $product = new Product();
        $form = $this->createFormBuilder($product)
            ->add('Name', 'text', array('required' => true,
                'label' => 'Pavadinimas ',
                'trim' => true))
            ->add('Photo', 'text', array('required' => true,
                'label' => 'Kategorijos paveiksliukas',
                'trim' => true))
            ->add('category', 'entity', array(
                'mapped'    => true,
                'class'     => 'NFQAkademijaBaseBundle:Category',
                'property'  => 'Name',
                'required'  => false,
                'label'     => 'Produkto kategorija'))
            ->add('Sukurti', 'submit')
            ->getForm();

        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isValid()) {
            $em->persist($product);
            $em->flush();
            return new Response('Naujo produkto id: '.$product->getId());
        } else {
            $entities = $em->getRepository('NFQAkademijaBaseBundle:Product')->findAll();
            return $this->render('NFQAkademijaRecipesBundle:Recipe:newProduct.html.twig', array(
                'form' => $form->createView(),
                'entities' => $entities,
            ));
        }
    }
}
