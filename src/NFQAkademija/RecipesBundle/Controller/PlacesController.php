<?php

namespace NFQAkademija\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

class PlacesController extends Controller
{
    public function indexAction()
    {
        //LOAD all places in radius 100km
        //now showing all places from DB
        //need to filter for radius 100km

        $places = [];
        $places_array = [];

        $em = $this->getDoctrine()->getManager();
        $places_repository = $em->getRepository("NFQAkademijaBaseBundle:Location");

        //places for sidebar, selects distinct places of BRAND
        $qb_for_places = $places_repository->createQueryBuilder('f');
        $qb_for_places = $qb_for_places->select('f.brand, f.title, f.icon AS imageUrl')
            ->orderBy('f.title', 'ASC')
            ->groupBy('f.brand')
            ->getQuery();
        $places = $qb_for_places->getResult();

        //places for manipulate in map
        $qb_for_places_array = $places_repository->createQueryBuilder('f');
        $qb_for_places_array = $qb_for_places_array->select('f.id, f.brand, f.title, f.icon AS imageUrl, f.type, f.latitude, f.longitude')
            ->orderBy('f.brand', 'ASC')
            ->getQuery();
        $places_array = $qb_for_places_array->getResult();

        return $this->render('NFQAkademijaRecipesBundle:Places:index.html.twig', array(
            'places' => $places,
            'places_array' => $places_array,
        ));
    }
}
