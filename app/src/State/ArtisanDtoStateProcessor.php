<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\DTO\ArtisanRequestDto;
use App\DTO\ArtisanResponseDto;
use App\Entity\Artisan;
use Doctrine\ORM\EntityManagerInterface;

class ArtisanDtoStateProcessor implements ProcessorInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): ArtisanResponseDto
    {
        if (!$data instanceof ArtisanRequestDto) {
            throw new \InvalidArgumentException('Expected ArtisanDto');
        }

        // Créer ou récupérer l'entité Doctrine
        $artisan = new Artisan();
        $artisan->setSexe($data->getSexe());
        $artisan->setEmail($data->getEmail());
        $artisan->setCategoryArtisan($data->getEmail());
        $artisan->setPhoto($data->getEmail());
        $artisan->setActiviteSecondaire($data->getEmail());
        $artisan->setNumeroPermisConduire($data->getEmail());
        $artisan->setIdentification($data->getEmail());
        $artisan->setPaysNaissance($data->getEmail());
        $artisan->setNationalite($data->getEmail());
        $artisan->setVilleNaissance($data->getEmail());
        $artisan->setActiviteSecondaire($data->getEmail());

        $artisan->setCrm($data->getCrmCode());

        $artisan->setLongitude($data->getEmail());
        $artisan->setLatitude($data->getEmail());
        $artisan->setNom($data->getEmail());
        $artisan->setNumeroRM($data->getEmail());

        $artisan->setEtatCivil($data->getEmail());
        $artisan->setWhatsapp($data->getEmail());
        $artisan->setTelephone($data->getEmail());
        $artisan->setTelephoneUrgence($data->getEmail());
        $artisan->setQuartier($data->getEmail());

        $artisan->setAutoriteDelivrancePieceIdentite();
        $artisan->setNumeroPieceIdentite($data->getEmail());
        $artisan->setTypePieceIdentite($data->getEmail());
        $artisan->setDateDelivrancePieceIdentite($data->getEmail());

        $artisan->setFormationApprentissageMetierDiplome($data->getEmail());
        $artisan->setFormationApprentissageMetier();
        $artisan->setFormationClasseEtude();
        $artisan->setFormationDiplomeObtenu();
        $artisan->setFormationNiveauEtude();

        $artisan->setActiviteExerceeLieu();
        $artisan->setActiviteSecondaire();
        $artisan->setActivitePrincipale();
        $artisan->setActiviteExercee();


        $this->entityManager->persist($artisan);
        $this->entityManager->flush();

        // Retourner le DTO avec l'ID généré
        $data->setId((string) $artisan->getId());

        return $this->mapEntityToResponseDto($data);
    }

    private function mapEntityToResponseDto(ArtisanRequestDto $artisan): ArtisanResponseDto
    {
        $dto = new ArtisanResponseDto();
        $dto->setId((string) $artisan->getId());
        $dto->setSexe((string) $artisan->getSexe());

        return $dto;
    }
}
