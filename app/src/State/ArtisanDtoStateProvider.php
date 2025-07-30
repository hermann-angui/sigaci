<?php

namespace App\State;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\DTO\ArtisanRequestDto;
use App\Entity\Artisan;
use App\Repository\ArtisanRepository;

class ArtisanDtoStateProvider implements ProviderInterface
{
    public function __construct(
        private readonly ArtisanRepository $artisanRepository
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
        $artisans = $this->artisanRepository->findAll();

        return array_map(function (Artisan $artisan) {
            return $this->mapEntityToDto($artisan);
        }, $artisans);
    }

    private function getItem(mixed $id): ?ArtisanRequestDto
    {
        $artisan = $this->artisanRepository->find($id);

        if (!$artisan) {
            return null;
        }

        return $this->mapEntityToDto($artisan);
    }

    private function mapEntityToDto(Artisan $artisan): ArtisanRequestDto
    {
        $dto = new ArtisanRequestDto();
        $dto->setId((string) $artisan->getId());

        return $dto;
    }
}
