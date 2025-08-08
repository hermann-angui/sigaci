<?php

namespace App\State;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\DTO\EntrepriseResponseDto;
use App\DTO\ObjectIdsResponseDto;
use App\Entity\CategoryArtisan;
use App\Entity\Communes;
use App\Entity\Crm;
use App\Entity\Department;
use App\Entity\Entreprise;
use App\Entity\Metiers;
use App\Entity\Pays;
use App\Entity\SousPrefecture;
use App\Entity\Villes;
use App\Repository\EntrepriseRepository;
use Doctrine\ORM\EntityManagerInterface;

class ObjectIdsStateProvider implements ProviderInterface
{

    public function __construct(private readonly EntityManagerInterface $entityManager) {}

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        if ($operation instanceof GetCollection) {
            return $this->getResponse();
        }

        if ($operation instanceof Get) {
           // return $this->getResponse($uriVariables['id'] ?? null);
            return $this->getResponse();
        }

        return null;
    }

    private function getResponse(): ?ObjectIdsResponseDto
    {
        $villes =  $this->entityManager->getRepository(Villes::class)->getCodeAndName();
        $communes =  $this->entityManager->getRepository(Communes::class)->getCodeAndName();
        $pays =  $this->entityManager->getRepository(Pays::class)->getCodeAndName();
        $metiers =  $this->entityManager->getRepository(Metiers::class)->getCodeAndName();
        $departments =  $this->entityManager->getRepository(Department::class)->getCodeAndName();
        $sousPrefectures =  $this->entityManager->getRepository(SousPrefecture::class)->getCodeAndName();
        $crms =  $this->entityManager->getRepository(Crm::class)->getCodeAndName();
        $categoryArtisans =  $this->entityManager->getRepository(CategoryArtisan::class)->getCodeAndName();

        $objects = new ObjectIdsResponseDto();
        $objects->setCommunes($communes);
        $objects->setMetiers($metiers);
        $objects->setSousPrefectures($sousPrefectures);
        $objects->setDepartments($departments);
        $objects->setCrms($crms);
        $objects->setPays($pays);
        $objects->setNationalities($sousPrefectures);
        $objects->setVilles($villes);
        $objects->setCategoryArtisans($categoryArtisans);

        return $objects;
    }


}
