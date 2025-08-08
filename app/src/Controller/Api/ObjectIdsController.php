<?php
namespace App\Controller\Api;

use App\DTO\ObjectIdsResponseDto;
use App\Entity\Communes;
use App\Entity\Crm;
use App\Entity\Department;
use App\Entity\Metiers;
use App\Entity\SousPrefecture;
use App\Entity\Villes;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class ObjectIdsController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager){}

    public function __invoke(Request $request): ObjectIdsResponseDto
    {
        $villes =  $this->entityManager->getRepository(Villes::class)->getCodeAndName();
        $communes =  $this->entityManager->getRepository(Communes::class)->getCodeAndName();
        $metiers =  $this->entityManager->getRepository(Metiers::class)->getCodeAndName();
        $departments =  $this->entityManager->getRepository(Department::class)->getCodeAndName();
        $sousPrefectures =  $this->entityManager->getRepository(SousPrefecture::class)->getCodeAndName();
        $crms =  $this->entityManager->getRepository(Crm::class)->getCodeAndName();

        $objects = new ObjectIdsResponseDto();
        $objects->setCorpsMetiers($villes);
        $objects->setCommunes($communes);
        $objects->setVilles($metiers);
        $objects->setSousPrefectures($sousPrefectures);
        $objects->setCrms($crms);
        $objects->setPays($departments);
        $objects->setNationalities($sousPrefectures);

        return $objects;
    }
}
