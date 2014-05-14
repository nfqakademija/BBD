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
                        'users' => $users,
                    ));
                break;

            case "locations": return $this->render('NFQAkademijaRecipesBundle:Admin:locations.html.twig',array());break;

            case "facts":
                $facts = "";
                $facts_data = $em->getRepository('NFQAkademijaBaseBundle:Fact')->findAll();
                foreach($facts_data as $fact){
                    $text = $fact->getText();
                    $id = $fact->getId();
                    $facts .=
                    "<div id='fact_$id'>
                        <div class='input_title'>$id</div>
                        <input type='text' class='new_recipe_input' placeholder='Faktas' value='$text'/>
                        <div class='sub_save' onclick=\"save_fact('$id')\"></div>
                        <div class='sub_delete' onclick=\"delete_fact('$id')\"></div>
                    </div>";
                }

                return $this->render('NFQAkademijaRecipesBundle:Admin:facts.html.twig',
                    array(
                        'facts' => $facts,
                    ));
                break;

            case "recipes": return $this->render('NFQAkademijaRecipesBundle:Admin:recipes.html.twig',array());break;
            case "filters": return $this->render('NFQAkademijaRecipesBundle:Admin:filters.html.twig',array());break;
            case "ingredients": return $this->render('NFQAkademijaRecipesBundle:Admin:ingredients.html.twig',array());break;

            case "comments":
                $comments = "";
                $comments_data = $em->getRepository('NFQAkademijaBaseBundle:Comment')->findAll();
                foreach($comments_data as $comment){
                    $text = $comment->getText();
                    $id = $comment->getId();
                    $user = "Autorius";//$comment->getUser()->getName();
                    $comments .=
                        "<div id='comment_$id'>
                        <div class='input_title'>$user</div>
                        <input type='text' class='new_recipe_input' placeholder='Komentaras' value='$text'/>
                        <div class='sub_save' onclick=\"save_comment('$id')\"></div>
                        <div class='sub_delete' onclick=\"delete_comment('$id')\"></div>
                    </div>";
                }

                return $this->render('NFQAkademijaRecipesBundle:Admin:comments.html.twig',
                    array(
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
