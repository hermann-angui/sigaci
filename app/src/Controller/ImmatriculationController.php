<?php

namespace App\Controller;

use App\Entity\Immatriculation;
use App\Form\ImmatriculationType;
use App\Repository\ImmatriculationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/immatriculation')]
class ImmatriculationController extends AbstractController
{
    #[Route('/', name: 'app_immatriculation_index', methods: ['GET'])]
    public function index(ImmatriculationRepository $immatriculationRepository): Response
    {
        return $this->render('immatriculation/index.html.twig', [
            'immatriculations' => $immatriculationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_immatriculation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ImmatriculationRepository $immatriculationRepository): Response
    {
        $immatriculation = new Immatriculation();
        $form = $this->createForm(ImmatriculationType::class, $immatriculation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $immatriculationRepository->add($immatriculation, true);

            return $this->redirectToRoute('app_immatriculation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('immatriculation/new.html.twig', [
            'immatriculation' => $immatriculation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_immatriculation_show', methods: ['GET'])]
    public function show(Immatriculation $immatriculation): Response
    {
        return $this->render('immatriculation/show.html.twig', [
            'immatriculation' => $immatriculation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_immatriculation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Immatriculation $immatriculation, ImmatriculationRepository $immatriculationRepository): Response
    {
        $form = $this->createForm(ImmatriculationType::class, $immatriculation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $immatriculationRepository->add($immatriculation, true);

            return $this->redirectToRoute('app_immatriculation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('immatriculation/edit.html.twig', [
            'immatriculation' => $immatriculation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_immatriculation_delete', methods: ['POST'])]
    public function delete(Request $request, Immatriculation $immatriculation, ImmatriculationRepository $immatriculationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$immatriculation->getId(), $request->request->get('_token'))) {
            $immatriculationRepository->remove($immatriculation, true);
        }

        return $this->redirectToRoute('app_immatriculation_index', [], Response::HTTP_SEE_OTHER);
    }
}
