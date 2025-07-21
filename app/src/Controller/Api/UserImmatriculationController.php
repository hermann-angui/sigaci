<?php

namespace App\Controller\Api;

use App\Repository\ImmatriculationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class UserImmatriculationController extends AbstractController
{
    public function __construct(
        private ImmatriculationRepository $repo
    ) {}

    #[Route('/api/users/{id}/immatriculations', name: 'user_immatriculations', methods: ['GET'])]
    public function __invoke(int $id): JsonResponse
    {
        $immatriculations = $this->repo->findBy(['agent' => $id]);

        return $this->json($immatriculations, 200, [], ['groups' => ['immatriculation:read']]);
    }
}
