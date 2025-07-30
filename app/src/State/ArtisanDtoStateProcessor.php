<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\DTO\ArtisanRequestDto;
use App\Entity\Artisan;
use Doctrine\ORM\EntityManagerInterface;

class ArtisanDtoStateProcessor implements ProcessorInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): ArtisanRequestDto
    {
        if (!$data instanceof ArtisanRequestDto) {
            throw new \InvalidArgumentException('Expected ArtisanDto');
        }

        // Créer ou récupérer l'entité Doctrine
        $artisan = new Artisan();
        $artisan->setSexe($data->getSexe());
        $artisan->setEmail($data->getEmail());

        $this->entityManager->persist($artisan);
        $this->entityManager->flush();

        // Retourner le DTO avec l'ID généré
        $data->setId((string) $artisan->getId());

        return $data;
    }
}
