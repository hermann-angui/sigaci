<?php

namespace App\Controller;

use App\Entity\Crm;
use App\Form\CrmType;
use App\Repository\CrmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/crm')]
class CrmController extends AbstractController
{
    #[Route('/', name: 'app_crm_index', methods: ['GET'])]
    public function index(CrmRepository $crmRepository): Response
    {
        return $this->render('crm/index.html.twig', [
            'crms' => $crmRepository->findAll(),
        ]);
    }


    #[Route('/ajax/select2', name: 'app_crm_select2_ajax', methods: ['GET', 'POST'])]
    public function ajaxSelect2(Request $request, CrmRepository $crmRepository): JsonResponse
    {
        // $crms = $crmRepository->findAllAjaxSelect2($request->get('search'));
        $crms = $crmRepository->findAllAjaxTagify($request->get('search'));
        return $this->json($crms);
    }

    #[Route('/new', name: 'app_crm_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CrmRepository $crmRepository): Response
    {
        $crm = new Crm();
        $form = $this->createForm(CrmType::class, $crm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $crmRepository->add($crm, true);

            return $this->redirectToRoute('app_crm_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crm/new.html.twig', [
            'crm' => $crm,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_crm_show', methods: ['GET'])]
    public function show(Crm $crm): Response
    {
        return $this->render('crm/show.html.twig', [
            'crm' => $crm,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_crm_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Crm $crm, CrmRepository $crmRepository): Response
    {
        $form = $this->createForm(CrmType::class, $crm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $crmRepository->add($crm, true);

            return $this->redirectToRoute('app_crm_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crm/edit.html.twig', [
            'crm' => $crm,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_crm_delete', methods: ['POST'])]
    public function delete(Request $request, Crm $crm, CrmRepository $crmRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$crm->getId(), $request->request->get('_token'))) {
            $crmRepository->remove($crm, true);
        }

        return $this->redirectToRoute('app_crm_index', [], Response::HTTP_SEE_OTHER);
    }
}
