<?php

namespace App\Controller;

use App\Entity\SousPrefecture;
use App\Form\SousPrefectureType;
use App\Repository\SousPrefectureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sous/prefecture')]
class SousPrefectureController extends AbstractController
{
    #[Route('/', name: 'app_sous_prefecture_index', methods: ['GET'])]
    public function index(SousPrefectureRepository $sousPrefectureRepository): Response
    {
        return $this->render('sous_prefecture/index.html.twig', [
            'sous_prefectures' => $sousPrefectureRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_sous_prefecture_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SousPrefectureRepository $sousPrefectureRepository): Response
    {
        $sousPrefecture = new SousPrefecture();
        $form = $this->createForm(SousPrefectureType::class, $sousPrefecture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sousPrefectureRepository->add($sousPrefecture, true);

            return $this->redirectToRoute('app_sous_prefecture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sous_prefecture/new.html.twig', [
            'sous_prefecture' => $sousPrefecture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sous_prefecture_show', methods: ['GET'])]
    public function show(SousPrefecture $sousPrefecture): Response
    {
        return $this->render('sous_prefecture/show.html.twig', [
            'sous_prefecture' => $sousPrefecture,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sous_prefecture_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SousPrefecture $sousPrefecture, SousPrefectureRepository $sousPrefectureRepository): Response
    {
        $form = $this->createForm(SousPrefectureType::class, $sousPrefecture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sousPrefectureRepository->add($sousPrefecture, true);

            return $this->redirectToRoute('app_sous_prefecture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sous_prefecture/edit.html.twig', [
            'sous_prefecture' => $sousPrefecture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sous_prefecture_delete', methods: ['POST'])]
    public function delete(Request $request, SousPrefecture $sousPrefecture, SousPrefectureRepository $sousPrefectureRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sousPrefecture->getId(), $request->request->get('_token'))) {
            $sousPrefectureRepository->remove($sousPrefecture, true);
        }

        return $this->redirectToRoute('app_sous_prefecture_index', [], Response::HTTP_SEE_OTHER);
    }
}
