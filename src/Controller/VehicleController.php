<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Vehicle;
use App\Entity\Part;
use App\Form\VehicleType;
use App\Form\PartType;
use App\Repository\VehicleRepository;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

#[Route('/vehicle')]
class VehicleController extends AbstractController
{
    #[Route('/', name: 'vehicle_index', methods: ['GET'])]
    public function index(VehicleRepository $vehicleRepository): Response
    {
        $this->denyAccessUnlessGranted("ROLE_USER");
        $user = $this->getUser();

        return $this->render('vehicle/index.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/new', name: 'vehicle_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $vehicle = new Vehicle();
        $form = $this->createForm(VehicleType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vehicle->setOwner($user);
            $entityManager->persist($vehicle);
            $entityManager->flush();

            return $this->redirectToRoute('vehicle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vehicle/new.html.twig', [
            'vehicle' => $vehicle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'vehicle_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Vehicle $vehicle, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VehicleType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('vehicle_parts', ['vehicle' => $vehicle->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vehicle/edit.html.twig', [
            'vehicle' => $vehicle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'vehicle_delete', methods: ['POST'])]
    public function delete(Request $request, Vehicle $vehicle, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $vehicle->getId(), strval($request->request->get('_token')))) {
            $entityManager->remove($vehicle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vehicle_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{vehicle}/parts', name: 'vehicle_parts', methods: ['GET'])]
    public function parts(Vehicle $vehicle): Response
    {
        if (!($this->getUser() == $vehicle->getOwner())) {
            throw new AccessDeniedException('Vous ne pouvez pas acceder a ce vehicule');
        }

        return $this->render('vehicle/parts.html.twig', [
            'vehicle' => $vehicle,
        ]);
    }

    #[Route('/{vehicle}/parts/new', name: 'vehicle_parts_new', methods: ['GET', 'POST'])]
    public function partsNew(Request $request, Vehicle $vehicle, EntityManagerInterface $entityManager): Response
    {
        $part = new Part();
        $part->setVehicle($vehicle);
        $part->setPartUseTime($vehicle->getUsedHour());
        $form = $this->createForm(PartType::class, $part);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($part);
            $entityManager->flush();

            return $this->redirectToRoute('vehicle_parts', [
                'vehicle' => $vehicle->getId(),
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vehicle/parts_new.html.twig', [
            'vehicle' => $vehicle,
            'part' => $part,
            'form' => $form,
        ]);
    }

    #[Route('/{vehicle}/parts/{part}/edit', name: 'vehicle_parts_edit', methods: ['GET', 'POST'])]
    public function partsEdit(
        Request $request,
        Vehicle $vehicle,
        Part $part,
        EntityManagerInterface $entityManager
    ): Response {
        $form = $this->createForm(PartType::class, $part);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('vehicle_parts', [
                'vehicle' => $vehicle->getId(),
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vehicle/parts_edit.html.twig', [
            'vehicle' => $vehicle,
            'part' => $part,
            'form' => $form,
        ]);
    }

    #[Route('/{vehicle}/parts/{part}', name: 'vehicle_parts_delete', methods: ['POST'])]
    public function partsDelete(
        Request $request,
        Vehicle $vehicle,
        Part $part,
        EntityManagerInterface $entityManager
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $part->getId(), strval($request->request->get('_token')))) {
            $entityManager->remove($part);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vehicle_parts', [
            'vehicle' => $vehicle->getId(),
        ], Response::HTTP_SEE_OTHER);
    }
}
