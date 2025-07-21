<?php

namespace App\Controller;

use App\Entity\CorpsMetiers;
use App\Form\CorpsMetiersType;
use App\Repository\CorpsMetiersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/corps/metiers')]
class CorpsMetiersController extends AbstractController
{
    #[Route('/', name: 'app_corps_metiers_index', methods: ['GET'])]
    public function index(CorpsMetiersRepository $corpsMetiersRepository): Response
    {
        return $this->render('corps_metiers/index.html.twig', [
            'corps_metiers' => $corpsMetiersRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_corps_metiers_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CorpsMetiersRepository $corpsMetiersRepository): Response
    {
        $corpsMetier = new CorpsMetiers();
        $form = $this->createForm(CorpsMetiersType::class, $corpsMetier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $corpsMetiersRepository->add($corpsMetier, true);

            return $this->redirectToRoute('app_corps_metiers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('corps_metiers/new.html.twig', [
            'corps_metier' => $corpsMetier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_corps_metiers_show', methods: ['GET'])]
    public function show(CorpsMetiers $corpsMetier): Response
    {
        return $this->render('corps_metiers/show.html.twig', [
            'corps_metier' => $corpsMetier,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_corps_metiers_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CorpsMetiers $corpsMetier, CorpsMetiersRepository $corpsMetiersRepository): Response
    {
        $form = $this->createForm(CorpsMetiersType::class, $corpsMetier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $corpsMetiersRepository->add($corpsMetier, true);

            return $this->redirectToRoute('app_corps_metiers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('corps_metiers/edit.html.twig', [
            'corps_metier' => $corpsMetier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_corps_metiers_delete', methods: ['POST'])]
    public function delete(Request $request, CorpsMetiers $corpsMetier, CorpsMetiersRepository $corpsMetiersRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$corpsMetier->getId(), $request->request->get('_token'))) {
            $corpsMetiersRepository->remove($corpsMetier, true);
        }

        return $this->redirectToRoute('app_corps_metiers_index', [], Response::HTTP_SEE_OTHER);
    }
}
