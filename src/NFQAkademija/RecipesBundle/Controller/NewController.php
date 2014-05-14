<?php

namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewController extends Controller
{
    public function indexAction()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        //get ingredients
        $options_ingredients = "";
        $ingredients = $em->getRepository('NFQAkademijaBaseBundle:Product')->findAll();
        foreach($ingredients as $ingredient){
            $title = $ingredient->getName();
            $id = $ingredient->getId();
            $options_ingredients .= "<option value='$id'>$title</option>";
        }

        //get types
        $options_types = "";
        $types = $em->getRepository('NFQAkademijaBaseBundle:Type')->findAll();
        foreach($types as $type){
            $title = $type->getName();
            $id = $type->getId();
            $options_types .= "<option value='$id'>$title</option>";
        }

        //get countries
        $options_countries = "";
        $countries = $em->getRepository('NFQAkademijaBaseBundle:Country')->findAll();
        foreach($countries as $country){
            $title = $country->getName();
            $id = $country->getId();
            $options_countries .= "<option value='$id'>$title</option>";
        }

        //get times
        $options_times = "";
        $times = $em->getRepository('NFQAkademijaBaseBundle:Time')->findAll();
        foreach($times as $time){
            $title = $time->getName();
            $id = $time->getId();
            $options_times .= "<option value='$id'>$title</option>";
        }

        //get celebrations
        $options_celebrations = "";
        $celebrations = $em->getRepository('NFQAkademijaBaseBundle:Celebration')->findAll();
        foreach($celebrations as $celebration){
            $title = $celebrations->getName();
            $id = $celebrations->getId();
            $options_celebrations .= "<option value='$id'>$title</option>";
        }

        //get main_cooking_methods
        $options_main_cooking_methods = "";
        $main_cooking_methods = $em->getRepository('NFQAkademijaBaseBundle:MainCookingMethod')->findAll();
        foreach($main_cooking_methods as $main_cooking_method){
            $title = $main_cooking_methods->getName();
            $id = $main_cooking_methods->getId();
            $options_main_cooking_methods .= "<option value='$id'>$title</option>";
        }

        //get units
        $options_units = "";
        $units = $em->getRepository('NFQAkademijaBaseBundle:Unit')->findAll();
        foreach($units as $unit){
            $title = $unit->getName();
            $id = $unit->getId();
            $options_units .= "<option value='$id'>$title</option>";
        }

        //get properties
        $checkboxes_properties = "";
        $properties = $em->getRepository('NFQAkademijaBaseBundle:Property')->findAll();
        foreach($properties as $property){
            $title = $property->getName();
            $id = $property->getId();
            $checkboxes_properties .= "<div class='new_recipe_checkbox properties_checkbox not_checked' id='new_recipe_checkbox_property_$id' onclick=\"property_indicator(this.id)\"><div class='new_recipe_checkbox_box'></div><div class='new_recipe_checkbox_title'>$title</div></div>";
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
