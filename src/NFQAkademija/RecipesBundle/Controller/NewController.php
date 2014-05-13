<?php

namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewController extends Controller
{
    public function indexAction()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $options_ingredients = "<option value='1'>Bananas</option>";
        $options_units = "<option value='vnt' selected>vnt</option>";

        $options_celebrations = "<option value='Kalėdos'>Kalėdos</option>";
        $options_main_cooking_methods = "<option value='Kalėdos'>Kalėdos</option>";
        $checkboxes_properties = "<div class='new_recipe_checkbox properties_checkbox not_checked' id='new_recipe_checkbox_property_1' onclick=\"property_indicator(this.id)\"><div class='new_recipe_checkbox_box'></div><div class='new_recipe_checkbox_title'>Ypatybė 1</div></div>";

        $options_types = "";
        $types = $em->getRepository('NFQAkademijaBaseBundle:Type')->findAll();
        foreach($types as $type){
            $title = $type->getName();
            $id = $type->getId();
            $options_types .= "<option value='$id'>$title</option>";
        }

        $options_countries = "";
        $countries = $em->getRepository('NFQAkademijaBaseBundle:Country')->findAll();
        foreach($countries as $country){
            $title = $country->getName();
            $id = $country->getId();
            $options_countries .= "<option value='$id'>$title</option>";
        }

        $options_times = "";
        $times = $em->getRepository('NFQAkademijaBaseBundle:Time')->findAll();
        foreach($countries as $country){
            $title = $country->getName();
            $id = $country->getId();
            $options_countries .= "<option value='$id'>$title</option>";
        }



        return $this->render('NFQAkademijaRecipesBundle:New:index.html.twig',
            array(
                "options_ingredients" => $options_ingredients,
                "options_units" => $options_units,
                "options_celebrations" => $options_celebrations,
                "options_main_cooking_methods" => $options_main_cooking_methods,
                "checkboxes_properties" => $checkboxes_properties,
                "options_types" => $options_types,
                "options_countries" => $options_countries,
                "options_times" => $options_times,
            ));
    }
}
