<?php

namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction($type)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        switch($type){
            case "users":
                /*
                $users = "";
                $users_data = $em->getRepository('NFQAkademijaBaseBundle:User')->findAll();
                foreach($users_data as $user){
                    $text = $fact->getText();
                    $id = $fact->getId();
                    $users .=
                        "<div id='user_$id'>
                        <div class='input_title'>$id</div>
                        <input type='text' class='new_recipe_input' placeholder='Faktas' value='$text'/>
                        <div class='sub_save' onclick=\"save_fact('$id')\"></div>
                        <div class='sub_delete' onclick=\"delete_fact('$id')\"></div>
                    </div>";
                }
                */
                $users = "";
                return $this->render('NFQAkademijaRecipesBundle:Admin:users.html.twig',
                    array(
                        'title' => 'Vartotojai',
                        'users' => $users,
                    ));
                break;

            case "locations":

                $locations = "";
                $locations_data = $em->getRepository('NFQAkademijaBaseBundle:Location')->findAll();
                foreach($locations_data as $location){
                    $id = $location->getId();
                    $title = $location->getTitle();
                    $lat = $location->getLatitude();
                    $long = $location->getLongitude();
                    $icon = $location->getIcon();
                    $about = $location->getAbout();

                    $locations .=
                        "<div id='location_$id'>
                        <div class='input_title'>$id</div>
                        <input type='text' class='new_recipe_input' placeholder='Faktas' value='$text'/>
                        <div class='sub_save' onclick=\"save_location('$id')\"></div>
                        <div class='sub_delete' onclick=\"delete_location('$id')\"></div>
                    </div>";
                }

                return $this->render('NFQAkademijaRecipesBundle:Admin:locations.html.twig',
                    array(
                        'title' => 'Vietos',
                        'locations' => $locations,
                    ));
                break;

            case "facts": return $this->render('NFQAkademijaRecipesBundle:Admin:facts.html.twig',array()); break;

            case "recipes": return $this->render('NFQAkademijaRecipesBundle:Admin:recipes.html.twig',array());break;
            case "filters": return $this->render('NFQAkademijaRecipesBundle:Admin:filters.html.twig',array());break;
            case "ingredients": return $this->render('NFQAkademijaRecipesBundle:Admin:ingredients.html.twig',array());break;

            case "comments":


                return $this->render('NFQAkademijaRecipesBundle:Admin:comments.html.twig',
                    array(
                        'title' => 'Komentarai',
                        'comments' => $comments,
                    ));
                break;

            case "options": return $this->render('NFQAkademijaRecipesBundle:Admin:options.html.twig',array());break;
            default: return $this->render('NFQAkademijaRecipesBundle:Admin:users.html.twig',array());break;
        }
    }

    public function loginAction(){
        return $this->render('NFQAkademijaRecipesBundle:Admin:login.html.twig',array());
    }
}
