<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\EntrepriseRepository;
use App\State\ArtisanDtoStateProcessor;
use App\State\ArtisanDtoStateProvider;
use App\State\EntrepriseDtoStateProcessor;
use App\State\EntrepriseDtoStateProvider;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    shortName: "Immatriculation Entreprise",
    operations: [
        new Get(
            uriTemplate: '/entreprise/{numeroImmatriculation}/immatriculation',
            input: EntrepriseDto::class,
            output: EntrepriseDto::class,
            provider: EntrepriseDtoStateProvider::class,
            processor: EntrepriseDtoStateProcessor::class,
        ),
        new Put(
            uriTemplate: '/entreprise/{numeroImmatriculation}/immatriculation',
            input: EntrepriseDto::class,
            output: EntrepriseDto::class,
            provider: EntrepriseDtoStateProvider::class,
            processor: EntrepriseDtoStateProcessor::class,
        ),
        new Post(
            uriTemplate: '/entreprise/immatriculation',
            input: EntrepriseDto::class,
            output: EntrepriseDto::class,
            name: 'ImmatriculationEntreprise',
            // controller:
            provider: EntrepriseDtoStateProvider::class,
            processor: EntrepriseDtoStateProcessor::class,
        ),
    ],
    normalizationContext: ['groups' => ['entreprise_dto:read']],
    denormalizationContext: ['groups' => ['entreprise_dto:create', 'entreprise_dto:update']],
)]
class EntrepriseDto
{
    #[Groups(['entreprise_dto:read','entreprise_dto:create', 'entreprise_dto:update'])]
    private ?string $raisonSocial;

    #[Groups(['entreprise_dto:read','entreprise_dto:create', 'entreprise_dto:update'])]
    private ?string $sigle;

    #[Groups(['entreprise_dto:read','entreprise_dto:create', 'entreprise_dto:update'])]
    private ?string $objetSocial;

    #[Groups(['entreprise_dto:read','entreprise_dto:create', 'entreprise_dto:update'])]
    private ?string $typeEntreprise;

    #[Groups(['entreprise_dto:read','entreprise_dto:create', 'entreprise_dto:update'])]
    private ?string $numeroRCCM;

    #[Groups(['entreprise_dto:read','entreprise_dto:create', 'entreprise_dto:update'])]
    private ?string $capitalSocial;

    #[Groups(['entreprise_dto:read','entreprise_dto:create', 'entreprise_dto:update'])]
    private ?string $regimeFiscal;

    #[Groups(['entreprise_dto:read','entreprise_dto:create', 'entreprise_dto:update'])]
    private ?string $nombreAssocie;

    #[Groups(['entreprise_dto:read','entreprise_dto:create', 'entreprise_dto:update'])]
    private ?string $dureePersonne;

    #[Groups(['entreprise_dto:read','entreprise_dto:create', 'entreprise_dto:update'])]
    private ?string $identifiantCnps;

    #[Groups(['entreprise_dto:read','entreprise_dto:create', 'entreprise_dto:update'])]
    private ?string $numeroContribuable;

    #[Groups(['entreprise_dto:read','entreprise_dto:create', 'entreprise_dto:update'])]
    private ?string $adressPostale;

    #[Groups(['entreprise_dto:read','entreprise_dto:create', 'entreprise_dto:update'])]
    private ?string $telephone;

    #[Groups(['entreprise_dto:read','entreprise_dto:create', 'entreprise_dto:update'])]
    private ?string $fax;

    #[Groups(['entreprise_dto:read','entreprise_dto:create', 'entreprise_dto:update'])]
    private ?string $quartier;

    #[Groups(['entreprise_dto:read','entreprise_dto:create', 'entreprise_dto:update'])]
    private ?string $village;

    #[Groups(['entreprise_dto:read','entreprise_dto:create', 'entreprise_dto:update'])]
    private ?string $lot;

    #[Groups(['entreprise_dto:read','entreprise_dto:create', 'entreprise_dto:update'])]
    private ?string $ilot;

    #[Groups(['entreprise_dto:read','entreprise_dto:create', 'entreprise_dto:update'])]
    private ?int $effectifSalarieHomme = null;

    #[Groups(['entreprise_dto:read','entreprise_dto:create', 'entreprise_dto:update'])]
    private ?int $effectifSalarieFemme;

    #[Groups(['entreprise_dto:read','entreprise_dto:create', 'entreprise_dto:update'])]
    private ?int $effectifApprentiHomme;

    #[Groups(['entreprise_dto:read','entreprise_dto:create', 'entreprise_dto:update'])]
    private ?int $effectifApprentiFemme;

    #[Groups(['entreprise_dto:read','entreprise_dto:create', 'entreprise_dto:update'])]
    private ?string $latitude;

    #[Groups(['entreprise_dto:read','entreprise_dto:create', 'entreprise_dto:update'])]
    private ?string $longitude;

    private ?string $departmentId = null;

    private ?string $communeId = null;

    private ?string $crmId = null;

    private ?string $sousPrefectureId = null;

    private ?string $villeId = null;

    /**
     * @return string|null
     */
    public function getRaisonSocial(): ?string
    {
        return $this->raisonSocial;
    }

    /**
     * @param string|null $raisonSocial
     * @return EntrepriseDto
     */
    public function setRaisonSocial(?string $raisonSocial): EntrepriseDto
    {
        $this->raisonSocial = $raisonSocial;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSigle(): ?string
    {
        return $this->sigle;
    }

    /**
     * @param string|null $sigle
     * @return EntrepriseDto
     */
    public function setSigle(?string $sigle): EntrepriseDto
    {
        $this->sigle = $sigle;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getObjetSocial(): ?string
    {
        return $this->objetSocial;
    }

    /**
     * @param string|null $objetSocial
     * @return EntrepriseDto
     */
    public function setObjetSocial(?string $objetSocial): EntrepriseDto
    {
        $this->objetSocial = $objetSocial;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTypeEntreprise(): ?string
    {
        return $this->typeEntreprise;
    }

    /**
     * @param string|null $typeEntreprise
     * @return EntrepriseDto
     */
    public function setTypeEntreprise(?string $typeEntreprise): EntrepriseDto
    {
        $this->typeEntreprise = $typeEntreprise;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumeroRCCM(): ?string
    {
        return $this->numeroRCCM;
    }

    /**
     * @param string|null $numeroRCCM
     * @return EntrepriseDto
     */
    public function setNumeroRCCM(?string $numeroRCCM): EntrepriseDto
    {
        $this->numeroRCCM = $numeroRCCM;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCapitalSocial(): ?string
    {
        return $this->capitalSocial;
    }

    /**
     * @param string|null $capitalSocial
     * @return EntrepriseDto
     */
    public function setCapitalSocial(?string $capitalSocial): EntrepriseDto
    {
        $this->capitalSocial = $capitalSocial;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRegimeFiscal(): ?string
    {
        return $this->regimeFiscal;
    }

    /**
     * @param string|null $regimeFiscal
     * @return EntrepriseDto
     */
    public function setRegimeFiscal(?string $regimeFiscal): EntrepriseDto
    {
        $this->regimeFiscal = $regimeFiscal;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNombreAssocie(): ?string
    {
        return $this->nombreAssocie;
    }

    /**
     * @param string|null $nombreAssocie
     * @return EntrepriseDto
     */
    public function setNombreAssocie(?string $nombreAssocie): EntrepriseDto
    {
        $this->nombreAssocie = $nombreAssocie;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDureePersonne(): ?string
    {
        return $this->dureePersonne;
    }

    /**
     * @param string|null $dureePersonne
     * @return EntrepriseDto
     */
    public function setDureePersonne(?string $dureePersonne): EntrepriseDto
    {
        $this->dureePersonne = $dureePersonne;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIdentifiantCnps(): ?string
    {
        return $this->identifiantCnps;
    }

    /**
     * @param string|null $identifiantCnps
     * @return EntrepriseDto
     */
    public function setIdentifiantCnps(?string $identifiantCnps): EntrepriseDto
    {
        $this->identifiantCnps = $identifiantCnps;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumeroContribuable(): ?string
    {
        return $this->numeroContribuable;
    }

    /**
     * @param string|null $numeroContribuable
     * @return EntrepriseDto
     */
    public function setNumeroContribuable(?string $numeroContribuable): EntrepriseDto
    {
        $this->numeroContribuable = $numeroContribuable;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAdressPostale(): ?string
    {
        return $this->adressPostale;
    }

    /**
     * @param string|null $adressPostale
     * @return EntrepriseDto
     */
    public function setAdressPostale(?string $adressPostale): EntrepriseDto
    {
        $this->adressPostale = $adressPostale;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    /**
     * @param string|null $telephone
     * @return EntrepriseDto
     */
    public function setTelephone(?string $telephone): EntrepriseDto
    {
        $this->telephone = $telephone;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFax(): ?string
    {
        return $this->fax;
    }

    /**
     * @param string|null $fax
     * @return EntrepriseDto
     */
    public function setFax(?string $fax): EntrepriseDto
    {
        $this->fax = $fax;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getQuartier(): ?string
    {
        return $this->quartier;
    }

    /**
     * @param string|null $quartier
     * @return EntrepriseDto
     */
    public function setQuartier(?string $quartier): EntrepriseDto
    {
        $this->quartier = $quartier;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getVillage(): ?string
    {
        return $this->village;
    }

    /**
     * @param string|null $village
     * @return EntrepriseDto
     */
    public function setVillage(?string $village): EntrepriseDto
    {
        $this->village = $village;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLot(): ?string
    {
        return $this->lot;
    }

    /**
     * @param string|null $lot
     * @return EntrepriseDto
     */
    public function setLot(?string $lot): EntrepriseDto
    {
        $this->lot = $lot;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIlot(): ?string
    {
        return $this->ilot;
    }

    /**
     * @param string|null $ilot
     * @return EntrepriseDto
     */
    public function setIlot(?string $ilot): EntrepriseDto
    {
        $this->ilot = $ilot;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getEffectifSalarieHomme(): ?int
    {
        return $this->effectifSalarieHomme;
    }

    /**
     * @param int|null $effectifSalarieHomme
     * @return EntrepriseDto
     */
    public function setEffectifSalarieHomme(?int $effectifSalarieHomme): EntrepriseDto
    {
        $this->effectifSalarieHomme = $effectifSalarieHomme;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getEffectifSalarieFemme(): ?int
    {
        return $this->effectifSalarieFemme;
    }

    /**
     * @param int|null $effectifSalarieFemme
     * @return EntrepriseDto
     */
    public function setEffectifSalarieFemme(?int $effectifSalarieFemme): EntrepriseDto
    {
        $this->effectifSalarieFemme = $effectifSalarieFemme;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getEffectifApprentiHomme(): ?int
    {
        return $this->effectifApprentiHomme;
    }

    /**
     * @param int|null $effectifApprentiHomme
     * @return EntrepriseDto
     */
    public function setEffectifApprentiHomme(?int $effectifApprentiHomme): EntrepriseDto
    {
        $this->effectifApprentiHomme = $effectifApprentiHomme;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getEffectifApprentiFemme(): ?int
    {
        return $this->effectifApprentiFemme;
    }

    /**
     * @param int|null $effectifApprentiFemme
     * @return EntrepriseDto
     */
    public function setEffectifApprentiFemme(?int $effectifApprentiFemme): EntrepriseDto
    {
        $this->effectifApprentiFemme = $effectifApprentiFemme;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    /**
     * @param string|null $latitude
     * @return EntrepriseDto
     */
    public function setLatitude(?string $latitude): EntrepriseDto
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    /**
     * @param string|null $longitude
     * @return EntrepriseDto
     */
    public function setLongitude(?string $longitude): EntrepriseDto
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDepartmentId(): ?string
    {
        return $this->departmentId;
    }

    /**
     * @param string|null $departmentId
     * @return EntrepriseDto
     */
    public function setDepartmentId(?string $departmentId): EntrepriseDto
    {
        $this->departmentId = $departmentId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCommuneId(): ?string
    {
        return $this->communeId;
    }

    /**
     * @param string|null $communeId
     * @return EntrepriseDto
     */
    public function setCommuneId(?string $communeId): EntrepriseDto
    {
        $this->communeId = $communeId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCrmId(): ?string
    {
        return $this->crmId;
    }

    /**
     * @param string|null $crmId
     * @return EntrepriseDto
     */
    public function setCrmId(?string $crmId): EntrepriseDto
    {
        $this->crmId = $crmId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSousPrefectureId(): ?string
    {
        return $this->sousPrefectureId;
    }

    /**
     * @param string|null $sousPrefectureId
     * @return EntrepriseDto
     */
    public function setSousPrefectureId(?string $sousPrefectureId): EntrepriseDto
    {
        $this->sousPrefectureId = $sousPrefectureId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getVilleId(): ?string
    {
        return $this->villeId;
    }

    /**
     * @param string|null $villeId
     * @return EntrepriseDto
     */
    public function setVilleId(?string $villeId): EntrepriseDto
    {
        $this->villeId = $villeId;
        return $this;
    }

}
