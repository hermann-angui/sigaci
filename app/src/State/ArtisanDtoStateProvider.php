<?php

namespace App\State;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\DTO\ArtisanResponseDto;
use App\Entity\Artisan;
use App\Repository\ArtisanRepository;

class ArtisanDtoStateProvider implements ProviderInterface
{
    public function __construct(private readonly ArtisanRepository $artisanRepository) {}

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

    private function getItem(mixed $id): ?ArtisanResponseDto
    {
        $artisan = $this->artisanRepository->find($id);

        if (!$artisan) {
            return null;
        }

        return $this->mapEntityToDto($artisan);
    }

    private function mapEntityToDto(Artisan $artisan): ArtisanResponseDto
    {
        $dto = new ArtisanResponseDto();
        $dto->setId((string) $artisan->getId());
        $dto->setSexe((string) $artisan->getSexe());
        $dto->setLongitude((string) $artisan->getLongitude());
        $dto->setLatitude((string) $artisan->getLatitude());
        $dto->setCnps((string) $artisan->getCnps());
        $dto->setCreatedAt( $artisan->getCreatedAt());

        return $dto;
    }
}
