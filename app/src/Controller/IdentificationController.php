<?php

namespace App\Controller;

use App\Entity\Identification;
use App\Form\IdentificationType;
use App\Repository\IdentificationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/identification')]
class IdentificationController extends AbstractController
{
    #[Route('/', name: 'app_identification_index', methods: ['GET'])]
    public function index(IdentificationRepository $identificationRepository): Response
    {
        return $this->render('identification/index.html.twig', [
            'identifications' => $identificationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_identification_new', methods: ['GET', 'POST'])]
    public function new(Request $request, IdentificationRepository $identificationRepository): Response
    {
        $identification = new Identification();
        $form = $this->createForm(IdentificationType::class, $identification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $identificationRepository->add($identification, true);

            return $this->redirectToRoute('app_identification_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('identification/new.html.twig', [
            'identification' => $identification,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_identification_show', methods: ['GET'])]
    public function show(Identification $identification): Response
    {
        return $this->render('identification/show.html.twig', [
            'identification' => $identification,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_identification_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Identification $identification, IdentificationRepository $identificationRepository): Response
    {
        $form = $this->createForm(IdentificationType::class, $identification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $identificationRepository->add($identification, true);

            return $this->redirectToRoute('app_identification_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('identification/edit.html.twig', [
            'identification' => $identification,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_identification_delete', methods: ['POST'])]
    public function delete(Request $request, Identification $identification, IdentificationRepository $identificationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$identification->getId(), $request->request->get('_token'))) {
            $identificationRepository->remove($identification, true);
        }

        return $this->redirectToRoute('app_identification_index', [], Response::HTTP_SEE_OTHER);
    }
}
