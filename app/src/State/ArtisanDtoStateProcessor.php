<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\DTO\ArtisanRequestDto;
use App\DTO\ArtisanResponseDto;
use App\Entity\Artisan;
use App\Entity\CategoryArtisan;
use App\Entity\Crm;
use App\Entity\Identification;
use App\Entity\Immatriculation;
use App\Entity\MediaObject;
use App\Entity\Metiers;
use App\Entity\Nationalities;
use App\Entity\Payment;
use App\Entity\Pays;
use App\Entity\Villes;
use App\Helper\ArtisanAssetHelper;
use App\Helper\CodificationHelper;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;
use Symfony\Component\Uid\Uuid;

class ArtisanDtoStateProcessor implements ProcessorInterface
{
    public function __construct(private readonly EntityManagerInterface $entityManager, private readonly ArtisanAssetHelper $artisanAssetHelper){
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): ArtisanResponseDto
    {
        if (!$data instanceof ArtisanRequestDto) {
            throw new InvalidArgumentException('Expected ArtisanDto');
        }

        $this->entityManager->beginTransaction();

            $lastRowId = $this->entityManager->getRepository(Artisan::class)->getLastRowId();

            $artisan = new Artisan();
            $artisan->setSexe($data->getSexe());
            $artisan->setEmail($data->getEmail());

            $categoryArtisan = $this->entityManager->getRepository(CategoryArtisan::class)->findOneBy(["code" => $data->getCategoryArtisanCode()]);
            $artisan->setCategoryArtisan($categoryArtisan);

            $crm = $this->entityManager->getRepository(Crm::class)->findOneBy(["code" => $data->getCrmCode()]);
            if ($crm) $artisan->setCrm($crm);

            switch (strtoupper($data->getTypeEnrolement())) {
                case 'IMMATRICULATION':
                    $immatriculation = new Immatriculation();
                    $immatriculation->setLatitude($data->getLatitude());
                    $immatriculation->setLongitude($data->getLongitude());
                    // $identification->setType();
                    // $identification->setAgent();
                    $immatriculation->setStatus("VALIDATION_EN_ATTENTE");
                    $immatriculation->setCreatedAt(new DateTime('now'));
                    $immatriculation->setPaymentType("MOBILE_MONEY");
                    $immatriculation->setNumeroReferenceExterne($data->getNumeroReferenceExterne());
                    $immatriculation->setCode(CodificationHelper::generateCodeImmatriculation(
                        $categoryArtisan->getCode(),
                        $crm->getCode(),
                        $crm->getAbbr(),
                        $data->getSexe(),
                        $lastRowId+1
                    ));
                    $this->entityManager->persist($immatriculation);
                    $this->entityManager->flush();

                    $payment = new Payment();
                    $payment->setReference(Uuid::v4()->toRfc4122());
                    // $payment->setType();
                    // $payment->setStatus();
                    // $payment->setPaymentFor();
                    // $payment->setUser();
                    $payment->setMontant($data->getMontant());
                    $payment->setOperateur("TRESORPAY");
                    $payment->setCodePaymentOperateur($data->getNumeroReferencePaiement());
                    $this->entityManager->persist($payment);
                    $this->entityManager->flush();
                    break;

                case 'IDENTIFICATION':
                    $identification = new Identification();
                    $identification->setNumeroReferenceExterne($data->getNumeroReferenceExterne());
                    $identification->setStatus("VALIDATION_EN_ATTENTE");
                    // $identification->setType();
                    // $identification->setAgent();
                    $identification->setLongitude($data->getLongitude());
                    $identification->setLatitude($data->getLatitude());
                    $identification->setCreatedAt(new DateTime());
                    $identification->setSource("BMI");
                    $identification->setCode(CodificationHelper::generateCodeIdentification(
                        $categoryArtisan->getCode(),
                        $crm->getCode(),
                        $lastRowId+1
                    ));
                    $this->entityManager->persist($identification);
                    $this->entityManager->flush();
                    break;
                default:
                    break;
            }

            $helper = $this->artisanAssetHelper;

            if ($data->getPhoto()) {
                $mediaObject = new MediaObject();
                $photo = $data->getPhoto();
                $mediaObject->setType($photo->getType());
                $mediaObject->setMimeType($photo->getMimeType());
                $mediaObject->setFilePath($photo->getPath());
                $this->entityManager->persist($mediaObject);
                $this->entityManager->flush();
                $artisan->setPhoto($mediaObject);

                $file = $helper->uploadAsset($data->getPhoto(), $helper->getDir($artisan));
                if ($file) $helper->createThumbnail($file, $helper->getDir($artisan), 64, 64);
                unset($mediaObject);
            }

            if ($data->getScanDocument()) {
                $mediaObject = new MediaObject();
                $scan = $data->getScanDocument();
                $mediaObject->setType($scan->getType());
                $mediaObject->setMimeType($scan->getMimeType());
                $mediaObject->setFilePath($scan->getPath());
                $this->entityManager->persist($mediaObject);
                $this->entityManager->flush();

                $artisan->setScanDocument($mediaObject);
                $helper->uploadAsset($data->getScanDocument(), $helper->getDir($artisan));
                unset($mediaObject);
            }

            $metier = $this->entityManager->getRepository(Metiers::class)->findOneBy(["code" => $data->getActiviteSecondaireCode()]);
            if($metier) $artisan->setActiviteSecondaire($metier);

            $artisan->setNumeroPermisConduire($data->getNumeroPermisConduire());
            $artisan->setIdentification($data->getCodeIdentification());

            $artisan->setLongitude($data->getLongitude());
            $artisan->setLatitude($data->getLatitude());
            $artisan->setNom($data->getNom());
            $artisan->setNumeroRM($data->getNumeroRM());

            $artisan->setEtatCivil($data->getEtatCivil());
            $artisan->setWhatsapp($data->getWhatsapp());
            $artisan->setTelephone($data->getTelephone());
            $artisan->setQuartier($data->getQuartier());

            $artisan->setAutoriteDelivrancePieceIdentite($data->getAutoriteDelivrancePieceIdentite());
            $artisan->setNumeroPieceIdentite($data->getNumeroPieceIdentite());
            $artisan->setTypePieceIdentite($data->getTypePieceIdentite());
            $artisan->setDateDelivrancePieceIdentite(new DateTime($data->getDateDelivrancePieceIdentite()));

            $artisan->setFormationApprentissageMetierDiplome($data->getFormationApprentissageMetierDiplome());
            $artisan->setFormationApprentissageMetier($data->getFormationApprentissageMetier());
            $artisan->setFormationClasseEtude($data->getFormationClasseEtude());
            $artisan->setFormationDiplomeObtenu($data->getFormationDiplomeObtenu());
            $artisan->setFormationNiveauEtude($data->getFormationNiveauEtude());
            $artisan->setActiviteExerceeLieu($data->getActiviteExerceeLieu());

            $metier = $this->entityManager->getRepository(Metiers::class)->findOneBy(["code" => $data->getActivitePrincipaleCode()]);
            if ($metier) $artisan->setActivitePrincipale($metier);

            $pays = $this->entityManager->getRepository(Pays::class)->findOneBy(['code' => $data->getPaysNaissanceCode()]);
            if ($pays) $artisan->setPaysNaissance($pays);

            $nationality = $this->entityManager->getRepository(Nationalities::class)->findOneBy(['code' => $data->getNationaliteCode()]);
            if ($nationality) $artisan->setNationalite($nationality);

            $villes = $this->entityManager->getRepository(Villes::class)->findOneBy(['code' => $data->getVilleNaissanceCode()]);
            $artisan->setVilleNaissance($villes);

            $metier = $this->entityManager->getRepository(Metiers::class)->findOneBy(["code" => $data->getActiviteExerceeCode()]);
            if ($metier) $artisan->setActiviteExercee($metier);

            $this->entityManager->persist($artisan);
            $this->entityManager->flush();

        $this->entityManager->commit();

        // Retourner le DTO avec l'ID généré
        //$data->setId((string) $artisan->getId());

        return $this->mapEntityToResponseDto($data);
    }

    private function mapEntityToResponseDto(ArtisanRequestDto $artisan): ArtisanResponseDto
    {
        $dto = new ArtisanResponseDto();
        $dto->setId((string)$artisan->getId());
        $dto->setSexe((string)$artisan->getSexe());
        $dto->setEmail((string)$artisan->getEmail());
        $dto->setFormationApprentissageMetierDiplome((string)$artisan->getFormationApprentissageMetierDiplome());
        $dto->setPhoto($artisan->getPhoto()->getPath());
        $dto->setCnps((string)$artisan->getCnps());

        return $dto;
    }
}
