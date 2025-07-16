<?php

namespace App\Controller;

use App\Entity\BrancheMetier;
use App\Form\BrancheMetierType;
use App\Repository\BranchMetierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/branche/metier')]
class BrancheMetierController extends AbstractController
{
    #[Route('/', name: 'app_branche_metier_index', methods: ['GET'])]
    public function index(BranchMetierRepository $branchMetierRepository): Response
    {
        return $this->render('branche_metier/index.html.twig', [
            'branche_metiers' => $branchMetierRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_branche_metier_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BranchMetierRepository $branchMetierRepository): Response
    {
        $brancheMetier = new BrancheMetier();
        $form = $this->createForm(BrancheMetierType::class, $brancheMetier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $branchMetierRepository->add($brancheMetier, true);

            return $this->redirectToRoute('app_branche_metier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('branche_metier/new.html.twig', [
            'branche_metier' => $brancheMetier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_branche_metier_show', methods: ['GET'])]
    public function show(BrancheMetier $brancheMetier): Response
    {
        return $this->render('branche_metier/show.html.twig', [
            'branche_metier' => $brancheMetier,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_branche_metier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BrancheMetier $brancheMetier, BranchMetierRepository $branchMetierRepository): Response
    {
        $form = $this->createForm(BrancheMetierType::class, $brancheMetier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $branchMetierRepository->add($brancheMetier, true);

            return $this->redirectToRoute('app_branche_metier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('branche_metier/edit.html.twig', [
            'branche_metier' => $brancheMetier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_branche_metier_delete', methods: ['POST'])]
    public function delete(Request $request, BrancheMetier $brancheMetier, BranchMetierRepository $branchMetierRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$brancheMetier->getId(), $request->request->get('_token'))) {
            $branchMetierRepository->remove($brancheMetier, true);
        }

        return $this->redirectToRoute('app_branche_metier_index', [], Response::HTTP_SEE_OTHER);
    }
}
