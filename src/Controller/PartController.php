<?php

namespace App\Controller;

use App\Entity\Part;
use App\Form\PartType;
use App\Repository\PartRepository;
use App\Repository\VehicleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/part')]
class PartController extends AbstractController
{
    #[Route('/', name: 'part_index', methods: ['GET'])]
    public function index(PartRepository $partRepository, VehicleRepository $vehicleRepository): Response
    {
        return $this->render('part/index.html.twig', [
            'parts' => $partRepository->findAll(),
            'vehicles' => $vehicleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'part_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $part = new Part();
        $form = $this->createForm(PartType::class, $part);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($part);
            $entityManager->flush();

            return $this->redirectToRoute('part_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('part/new.html.twig', [
            'part' => $part,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'part_show', methods: ['GET'])]
    public function show(Part $part): Response
    {
        return $this->render('part/show.html.twig', [
            'part' => $part,
        ]);
    }

    #[Route('/{id}/edit', name: 'part_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Part $part, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PartType::class, $part);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('part_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('part/edit.html.twig', [
            'part' => $part,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'part_delete', methods: ['POST'])]
    public function delete(Request $request, Part $part, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $part->getId(), strval($request->request->get('_token')))) {
            $entityManager->remove($part);
            $entityManager->flush();
        }

        return $this->redirectToRoute('part_index', [], Response::HTTP_SEE_OTHER);
    }
}
