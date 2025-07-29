<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Entity\Artisan;
use App\Entity\ArtisanDto;
use App\Repository\ArtisanRepository;

class ArtisanDtoStateProvider implements ProviderInterface
{
    public function __construct(
        private readonly ArtisanRepository $artisanRepository
    ) {}

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        if ($operation instanceof \ApiPlatform\Metadata\GetCollection) {
            return $this->getCollection();
        }

        if ($operation instanceof \ApiPlatform\Metadata\Get) {
            return $this->getItem($uriVariables['id'] ?? null);
        }

        return null;
    }

    private function getCollection(): array
    {
        $artisans = $this->artisanRepository->findAll();

        return array_map(function (Artisan $artisan) {
            return $this->mapEntityToDto($artisan);
        }, $artisans);
    }

    private function getItem(mixed $id): ?ArtisanDto
    {
        $artisan = $this->artisanRepository->find($id);

        if (!$artisan) {
            return null;
        }

        return $this->mapEntityToDto($artisan);
    }

    private function mapEntityToDto(Artisan $artisan): ArtisanDto
    {
        $dto = new ArtisanDto();
        $dto->setId((string) $artisan->getId());
        $dto->setName($artisan->getName());
        $dto->setEmail($artisan->getEmail());
        $dto->setSpecialty($artisan->getSpecialty());
        $dto->setCreatedAt($artisan->getCreatedAt());

        return $dto;
    }
}
