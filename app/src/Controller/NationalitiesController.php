<?php

namespace App\Controller;

use App\Entity\Nationalities;
use App\Form\NationalitiesType;
use App\Repository\NationalitiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/nationalities')]
class NationalitiesController extends AbstractController
{
    #[Route('/', name: 'app_nationalities_index', methods: ['GET'])]
    public function index(NationalitiesRepository $nationalitiesRepository): Response
    {
        return $this->render('nationalities/index.html.twig', [
            'nationalities' => $nationalitiesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_nationalities_new', methods: ['GET', 'POST'])]
    public function new(Request $request, NationalitiesRepository $nationalitiesRepository): Response
    {
        $nationality = new Nationalities();
        $form = $this->createForm(NationalitiesType::class, $nationality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nationalitiesRepository->add($nationality, true);

            return $this->redirectToRoute('app_nationalities_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nationalities/new.html.twig', [
            'nationality' => $nationality,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_nationalities_show', methods: ['GET'])]
    public function show(Nationalities $nationality): Response
    {
        return $this->render('nationalities/show.html.twig', [
            'nationality' => $nationality,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_nationalities_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Nationalities $nationality, NationalitiesRepository $nationalitiesRepository): Response
    {
        $form = $this->createForm(NationalitiesType::class, $nationality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nationalitiesRepository->add($nationality, true);

            return $this->redirectToRoute('app_nationalities_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nationalities/edit.html.twig', [
            'nationality' => $nationality,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_nationalities_delete', methods: ['POST'])]
    public function delete(Request $request, Nationalities $nationality, NationalitiesRepository $nationalitiesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nationality->getId(), $request->request->get('_token'))) {
            $nationalitiesRepository->remove($nationality, true);
        }

        return $this->redirectToRoute('app_nationalities_index', [], Response::HTTP_SEE_OTHER);
    }
}
