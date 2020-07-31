<?php

namespace App\Controller;

use App\Entity\Plant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PlantController extends AbstractController
{
    /**
     * @Route("/plant", name="plant")
     */
    public function index(Request $request)
    {
        $filters = array();
        $filters_map = array('life_cycle','root','stratum','drought_tolerance','foliage','leaf_density','limestone');
        foreach ($filters_map as $filter){
            if ($request->query->get($filter)){
                $filters[$filter] = $request->query->get($filter);
            }
        }
        //complex filter (join)
        //'insolation','port'
        $complex_filters_map = array('family');
        foreach ($complex_filters_map as $filter){
            if ($request->query->get($filter)){
                $filters[$filter] = $request->query->get($filter);
            }
        }
        $plants = $this->getDoctrine()->getRepository(Plant::class)->findBy($filters);
        return $this->render('plant/index.html.twig', [
            'controller_name' => 'PlantController',
            'plants' => $plants,
            'filters' => $filters
        ]);
    }

    /**
     * @Route("/plant/card/{id}/{slug}", name="plant_show")
     */
    public function show(Plant $plant,string $slug)
    {
        if ($plant->getSlug() != $slug){
            return $this->redirectToRoute('plant_show',array('id'=>$plant->getId(),'slug'=>$plant->getSlug()));
        }
        return $this->render('plant/show.html.twig', [
            'plant' => $plant
        ]);
    }
}
