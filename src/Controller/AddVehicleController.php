<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddVehicleController extends AbstractController
{
    #[Route('/addVehicle', name: 'add_vehicle')]
    public function index(): Response
    {
        return $this->render('add_vehicle/addVehicle.html.twig', [
            'controller_name' => 'AddVehicleController',
        ]);
    }
}
