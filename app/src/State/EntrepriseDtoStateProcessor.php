<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\DTO\EntrepriseRequestDto;
use App\Entity\Crm;
use App\Entity\Department;
use App\Entity\Entreprise;
use App\Entity\EntrepriseActivite;
use App\Entity\Identification;
use App\Entity\Immatriculation;
use App\Entity\Payment;
use App\Entity\Villes;
use App\Helper\CodificationHelper;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;
use Symfony\Component\Uid\Uuid;

class EntrepriseDtoStateProcessor implements ProcessorInterface
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): void
    {
        if (!$data instanceof EntrepriseRequestDto) {
            throw new InvalidArgumentException('Expected Entreprise Request Dto');
        }

        $this->entityManager->beginTransaction();

        $lastRowId = $this->entityManager->getRepository(Entreprise::class)->getLastRowId();

        $crm = $this->entityManager->getRepository(Crm::class)->findOneBy(["code" => $data->getCrmCode()]);

        switch (strtoupper($data->getTypeEnrolement())) {
            case 'IMMATRICULATION':
                $immatriculation = new Immatriculation();
                $immatriculation->setLatitude($data->getLatitude());
                $immatriculation->setLongitude($data->getLongitude());
                // $identification->setType();
                // $identification->setAgent();
                $immatriculation->setStatus("VALIDATION_EN_ATTENTE");
                $immatriculation->setCreatedAt(new \DateTime('now'));
                $immatriculation->setPaymentType("MOBILE_MONEY");
                $immatriculation->setNumeroReferenceExterne($data->getNumeroReferenceExterne());
                $immatriculation->setCode(CodificationHelper::generateCodeImmatriculation(
                    "EA",
                    $crm->getCode(),
                    $crm->getAbbr(),
                    $data->getGerantSexe(),
                    $lastRowId + 1
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

                $entreprise = $this->entityManager
                    ->getRepository(Entreprise::class)
                    ->findOneBy([
                        "numeroRCCM" => $data->getNumeroRCCM(),
                        "numeroContribuable" => $data->getNumeroContribuable()
                    ]);

                if(!$entreprise) $entreprise = new Entreprise();
                $entreprise->setLatitude($data->getLatitude());
                $entreprise->setLongitude($data->getLongitude());
                $entreprise->setQuartier($data->getQuartier());
                $entreprise->setAdressPostale($data->getAdressePostale());
                $entreprise->setCapitalSocial($data->getCapitalSocial());
                $entreprise->setDateDebutActivite($data->getDateDebutActivite());
                $entreprise->setDureePersonne($data->getDureePersonne());
                $entreprise->setEffectifApprentiFemme($data->getEffectifApprentiFemme());
                $entreprise->setEffectifApprentiHomme($data->getEffectifApprentiHomme());
                $entreprise->setEffectifSalarieFemme($data->getEffectifSalarieFemme());
                $entreprise->setEffectifSalarieHomme($data->getEffectifSalarieHomme());
                $entreprise->setFax($data->getFax());
                $entreprise->setIdentifiantCnps($data->getIdentifiantCnps());
                $entreprise->setIlot($data->getIlot());
                $entreprise->setLot($data->getLot());
                $entreprise->setNombreAssocie($data->getNombreAssocie());
                $entreprise->setNumeroContribuable($data->getNumeroContribuable());
                $entreprise->setObjetSocial($data->getObjetSocial());
                $entreprise->setRaisonSocial($data->getRaisonSocial());
                $entreprise->setRegimeFiscal($data->getRegimeFiscal());
                $entreprise->setNumeroRCCM($data->getNumeroRCCM());
                $entreprise->setCapitalSocial($data->getCapitalSocial());
                $entreprise->setSigle($data->getSigle());
                $entreprise->setVillage($data->getVillage());

                $ville = $this->entityManager->getRepository(Villes::class)->findOneBy(["code" => $data->getVilleCode()]);
                $entreprise->setVille($ville);

                $department = $this->entityManager->getRepository(Department::class)->findOneBy(["code" => $data->getDepartmentCode()]);
                $entreprise->setDepartment($department);

                $commune = $this->entityManager->getRepository(Department::class)->findOneBy(["code" => $data->getCommuneCode()]);
                $entreprise->setCommune($commune);

                $entreprise->setCrm($crm);

                $this->entityManager->persist($entreprise);
                $this->entityManager->flush();

                $activiteEntreprise = $this->entityManager->getRepository(EntrepriseActivite::class)->findOneBy([
                    'entreprise' => $entreprise,
                    'activite' => $data->getActiviteCode()
                ]);

                if(!$activiteEntreprise) $activiteEntreprise = new EntrepriseActivite();
                //$activiteEntreprise->setDateDebutActivite();
                $activiteEntreprise->setVille($data->getVilleCode());
                $activiteEntreprise->setCrm($crm);
                $activiteEntreprise->setCommune($commune);
                $activiteEntreprise->setLongitude($data->getLongitude());
                $activiteEntreprise->setLatitude($data->getLatitude());
                $activiteEntreprise->setSigle($data->getSigle());
                $activiteEntreprise->setRaisonSocial($data->getRaisonSocial());
                $activiteEntreprise->setCapitalSocial($data->getCapitalSocial());
                $activiteEntreprise->setNumeroRCCM($data->getNumeroRCCM());
                $activiteEntreprise->setRegimeFiscal($data->getRegimeFiscal());
                $activiteEntreprise->setObjetSocial($data->getObjetSocial());
                $activiteEntreprise->setNumeroContribuable($data->getNumeroContribuable());
                $activiteEntreprise->setNombreAssocie($data->getNombreAssocie());
                $activiteEntreprise->setIdentifiantCnps($data->getIdentifiantCnps());
                $activiteEntreprise->setLot($data->getLot());
                $activiteEntreprise->setIlot($data->getIlot());
                $activiteEntreprise->setDureePersonne($data->getDureePersonne());
                $activiteEntreprise->setQuartier($data->getQuartier());
                $activiteEntreprise->setDepartment($entreprise);
                $activiteEntreprise->setTelephone($data->getTelephone());
                $activiteEntreprise->setFax($data->getFax());
                $activiteEntreprise->setEffectifSalarieFemme($data->getEffectifSalarieFemme());
                $activiteEntreprise->setEffectifSalarieHomme($data->getEffectifSalarieHomme());
                $activiteEntreprise->setEffectifApprentiFemme($data->getEffectifApprentiFemme());
                $activiteEntreprise->setEffectifApprentiHomme($data->getEffectifApprentiHomme());
                $activiteEntreprise->setDateDebutActivite($data->getDateDebutActivite());
                $activiteEntreprise->setVille($data->getVilleCode());
                $activiteEntreprise->setCrm($crm);
                $activiteEntreprise->setCommune($commune);
                $this->entityManager->persist($activiteEntreprise);
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
                    "EA",
                    $crm->getCode(),
                    $lastRowId+1
                ));
                $this->entityManager->persist($identification);
                $this->entityManager->flush();

                $entreprise = $this->entityManager
                    ->getRepository(Entreprise::class)
                    ->findOneBy([
                        "numeroRCCM" => $data->getNumeroRCCM(),
                        "numeroContribuable" => $data->getNumeroContribuable()
                    ]);

                if(!$entreprise) $entreprise = new Entreprise();
                $entreprise->setLatitude($data->getLatitude());
                $entreprise->setLongitude($data->getLongitude());
                $entreprise->setQuartier($data->getQuartier());
                $entreprise->setAdressPostale($data->getAdressePostale());
                $entreprise->setCapitalSocial($data->getCapitalSocial());
                $entreprise->setDateDebutActivite($data->getDateDebutActivite());
                $entreprise->setDureePersonne($data->getDureePersonne());
                $entreprise->setEffectifApprentiFemme($data->getEffectifApprentiFemme());
                $entreprise->setEffectifApprentiHomme($data->getEffectifApprentiHomme());
                $entreprise->setEffectifSalarieFemme($data->getEffectifSalarieFemme());
                $entreprise->setEffectifSalarieHomme($data->getEffectifSalarieHomme());
                $entreprise->setFax($data->getFax());
                $entreprise->setIdentifiantCnps($data->getIdentifiantCnps());
                $entreprise->setIlot($data->getIlot());
                $entreprise->setLot($data->getLot());
                $entreprise->setNombreAssocie($data->getNombreAssocie());
                $entreprise->setNumeroContribuable($data->getNumeroContribuable());
                $entreprise->setObjetSocial($data->getObjetSocial());
                $entreprise->setRaisonSocial($data->getRaisonSocial());
                $entreprise->setRegimeFiscal($data->getRegimeFiscal());
                $entreprise->setNumeroRCCM($data->getNumeroRCCM());
                $entreprise->setCapitalSocial($data->getCapitalSocial());
                $entreprise->setSigle($data->getSigle());
                $entreprise->setVillage($data->getVillage());

                $ville = $this->entityManager->getRepository(Villes::class)->findOneBy(["code" => $data->getVilleCode()]);
                $entreprise->setVille($ville);

                $department = $this->entityManager->getRepository(Department::class)->findOneBy(["code" => $data->getDepartmentCode()]);
                $entreprise->setDepartment($department);

                $commune = $this->entityManager->getRepository(Department::class)->findOneBy(["code" => $data->getCommuneCode()]);
                $entreprise->setCommune($commune);

                $entreprise->setCrm($crm);

                $this->entityManager->persist($entreprise);
                $this->entityManager->flush();

                $activiteEntreprise = $this->entityManager->getRepository(EntrepriseActivite::class)->findOneBy([
                    'entreprise' => $entreprise,
                    'activite' => $data->getActiviteCode()
                ]);

                if(!$activiteEntreprise) $activiteEntreprise = new EntrepriseActivite();
                //$activiteEntreprise->setDateDebutActivite();
                $activiteEntreprise->setVille($data->getVilleCode());
                $activiteEntreprise->setCrm($crm);
                $activiteEntreprise->setCommune($commune);
                $activiteEntreprise->setLongitude($data->getLongitude());
                $activiteEntreprise->setLatitude($data->getLatitude());
                $activiteEntreprise->setSigle($data->getSigle());
                $activiteEntreprise->setRaisonSocial($data->getRaisonSocial());
                $activiteEntreprise->setCapitalSocial($data->getCapitalSocial());
                $activiteEntreprise->setNumeroRCCM($data->getNumeroRCCM());
                $activiteEntreprise->setRegimeFiscal($data->getRegimeFiscal());
                $activiteEntreprise->setObjetSocial($data->getObjetSocial());
                $activiteEntreprise->setNumeroContribuable($data->getNumeroContribuable());
                $activiteEntreprise->setNombreAssocie($data->getNombreAssocie());
                $activiteEntreprise->setIdentifiantCnps($data->getIdentifiantCnps());
                $activiteEntreprise->setLot($data->getLot());
                $activiteEntreprise->setIlot($data->getIlot());
                $activiteEntreprise->setDureePersonne($data->getDureePersonne());
                $activiteEntreprise->setQuartier($data->getQuartier());
                $activiteEntreprise->setDepartment($entreprise);
                $activiteEntreprise->setTelephone($data->getTelephone());
                $activiteEntreprise->setFax($data->getFax());
                $activiteEntreprise->setEffectifSalarieFemme($data->getEffectifSalarieFemme());
                $activiteEntreprise->setEffectifSalarieHomme($data->getEffectifSalarieHomme());
                $activiteEntreprise->setEffectifApprentiFemme($data->getEffectifApprentiFemme());
                $activiteEntreprise->setEffectifApprentiHomme($data->getEffectifApprentiHomme());
                $activiteEntreprise->setDateDebutActivite($data->getDateDebutActivite());
                $activiteEntreprise->setVille($data->getVilleCode());
                $activiteEntreprise->setCrm($crm);
                $activiteEntreprise->setCommune($commune);
                $this->entityManager->persist($activiteEntreprise);
                $this->entityManager->flush();
                break;
            default:
                break;
        }

    }
}
