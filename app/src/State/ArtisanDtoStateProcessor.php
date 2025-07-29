<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Artisan;
use App\Entity\ArtisanDto;
use Doctrine\ORM\EntityManagerInterface;

class ArtisanDtoStateProcessor implements ProcessorInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): ArtisanDto
    {
        if (!$data instanceof ArtisanDto) {
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
