<?php

namespace App\State;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\DTO\EntrepriseResponseDto;
use App\Entity\Entreprise;
use Doctrine\ORM\EntityManagerInterface;

class EntrepriseDtoStateProvider implements ProviderInterface
{

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {}
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        if ($operation instanceof GetCollection) {
            return $this->getCollection();
        }

        if ($operation instanceof Get) {
            return $this->getItem($uriVariables['id'] ?? null);
        }

        return null;
    }

    private function getCollection(): array
    {
        $entreprise = $this->entityManager->getRepository(Entreprise::class)->findAll();

        return array_map(function (Entreprise $entreprise) {
            return $this->mapEntityToDto($entreprise);
        }, $entreprise);
    }

    private function getItem(mixed $id): ?EntrepriseResponseDto
    {
        $artisan = $this->entityManager->find($id);

        if (!$artisan) {
            return null;
        }

        return $this->mapEntityToDto($artisan);
    }

    private function mapEntityToDto(Entreprise $entreprise): EntrepriseResponseDto
    {
        $dto = new EntrepriseResponseDto();
        $dto->setId((string) $entreprise->getId());

        $dto->setEntrepriseNumeroIdentification(null);
        $dto->setEntrepriseNumeroIdentification(null);


        return $dto;
    }
}
