<?php

namespace App\DTO;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\State\EntrepriseDtoStateProcessor;
use App\State\EntrepriseDtoStateProvider;
use DateTimeInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Uid\Uuid;


#[ApiResource(
    shortName: "Immatriculation Entreprise",
    operations: [
        new Get(
            uriTemplate: '/entreprise/{numeroImmatriculation}/immatriculation',
            input: EntrepriseRequestDto::class,
            output: EntrepriseRequestDto::class,
            provider: EntrepriseDtoStateProvider::class,
            processor: EntrepriseDtoStateProcessor::class,
        ),
        new Put(
            uriTemplate: '/entreprise/{numeroImmatriculation}/immatriculation',
            input: EntrepriseRequestDto::class,
            output: EntrepriseResponseDto::class,
            provider: EntrepriseDtoStateProvider::class,
            processor: EntrepriseDtoStateProcessor::class,
        ),
        new Post(
            uriTemplate: '/entreprise/immatriculation',
            inputFormats: ['multipart' => ['multipart/form-data']],
        //  controller: ArtisanImmatriculationController::class,
            input: EntrepriseRequestDto::class,
            output: EntrepriseResponseDto::class,
//          read: false,
//          deserialize: false,
//          validate: true,
//          write: false,
            provider: EntrepriseDtoStateProvider::class,
            processor: EntrepriseDtoStateProcessor::class,
            extraProperties: [
                'multipart' => true,
                'standard_put' => false,
                'rfc_7807_compliant_errors' => true
            ]
        ),
    ],
    // normalizationContext: ['groups' => ['artisan_dto:read']],
    // denormalizationContext: ['groups' => ['artisan_dto:create', 'artisan_dto:update']],
)]
class EntrepriseRequestDto
{
    private ?int $id = null;

    private ?string $raisonSocial = null;

    private ?string $sigle = null;

    private ?string $reference;

    private ?string $objetSocial = null;

    private ?string $typeEntreprise = null;

    private ?string $numeroRCCM = null;

    private ?int $capitalSocial = null;

    private ?string $regimeFiscal = null;

    private ?int $nombreAssocie = null;

    private ?string $dureePersonne = null;

    private ?string $identifiantCnps = null;

    #[Assert\File(
        maxSize: '10M',
        mimeTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/svg', 'application/pdf'],
    )]
    //#[Groups(['artisan_dto:create'])]
    private ?File $scanDocument = null;

    private ?string $numeroContribuable = null;

    private ?string $adressePostale = null;

    private ?string $telephone = null;

    private ?string $fax = null;

    private ?string $quartier = null;

    private ?string $village = null;

    private ?string $lot = null;

    private ?string $ilot = null;

    private ?int $effectifSalarieHomme = null;

    private ?int $effectifSalarieFemme = null;

    private ?int $effectifApprentiHomme = null;

    private ?int $effectifApprentiFemme = null;

    private ?string $latitude = null;

    private ?int $montant = null;

    private ?string $numeroReferencePaiement = null;

    private ?string $numeroReferenceExterne = null;

    private ?string $categoryArtisanCode = null;

    private ?DateTimeInterface $dateDebutActivite;

    private ?string $longitude = null;

    private ?string $departmentCode = null;

    private ?string $communeCode = null;

    private ?string $crmCode = null;

    private ?string $sousPrefectureCode = null;

    private ?string $villeCode = null;

    private ?string $activiteCode = null;

    private ?string $gerantNom = null;

    private ?string $gerantPrenoms = null;

    private ?DateTimeInterface $gerantDateNaissance = null;

    private ?string $gerantLieuNaissance = null;

    private ?string $gerantSexe = null;

    private ?string $gerantDomicile = null;

    private ?string $gerantQuartier = null;

    private ?string $typeEnrolement = null;

    private ?string $gerantTypePieceIdentite = null;

    private ?string $gerantNumeroPieceIdentite = null;

    private ?string $gerantLieuDelivrancePieceIdentite = null;

    private ?DateTimeInterface $gerantDateDelivrancePieceIdentite = null;

    private ?string $gerantAutoriteDelivrancePieceIdentite = null;

    private ?string $gerantEtatCivil = null;

    private ?string $gerantReference = null;

    private ?string $gerantVilleNaissanceCode = null;

    private ?string $gerantPaysNaissanceCode = null;

    private ?string $gerantNationaliteCode = null;

    private ?string $gerantTelephone = null;

    private ?string $gerantEmail = null;


    public function __construct()
    {
        $this->reference = Uuid::v4()->toString();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return EntrepriseRequestDto
     */
    public function setId(?int $id): EntrepriseRequestDto
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRaisonSocial(): ?string
    {
        return $this->raisonSocial;
    }

    /**
     * @param string|null $raisonSocial
     * @return EntrepriseRequestDto
     */
    public function setRaisonSocial(?string $raisonSocial): EntrepriseRequestDto
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
     * @return EntrepriseRequestDto
     */
    public function setSigle(?string $sigle): EntrepriseRequestDto
    {
        $this->sigle = $sigle;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * @param string|null $reference
     * @return EntrepriseRequestDto
     */
    public function setReference(?string $reference): EntrepriseRequestDto
    {
        $this->reference = $reference;
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
     * @return EntrepriseRequestDto
     */
    public function setObjetSocial(?string $objetSocial): EntrepriseRequestDto
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
     * @return EntrepriseRequestDto
     */
    public function setTypeEntreprise(?string $typeEntreprise): EntrepriseRequestDto
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
     * @return EntrepriseRequestDto
     */
    public function setNumeroRCCM(?string $numeroRCCM): EntrepriseRequestDto
    {
        $this->numeroRCCM = $numeroRCCM;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCapitalSocial(): ?int
    {
        return $this->capitalSocial;
    }

    /**
     * @param int|null $capitalSocial
     * @return EntrepriseRequestDto
     */
    public function setCapitalSocial(?int $capitalSocial): EntrepriseRequestDto
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
     * @return EntrepriseRequestDto
     */
    public function setRegimeFiscal(?string $regimeFiscal): EntrepriseRequestDto
    {
        $this->regimeFiscal = $regimeFiscal;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNombreAssocie(): ?int
    {
        return $this->nombreAssocie;
    }

    /**
     * @param int|null $nombreAssocie
     * @return EntrepriseRequestDto
     */
    public function setNombreAssocie(?int $nombreAssocie): EntrepriseRequestDto
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
     * @return EntrepriseRequestDto
     */
    public function setDureePersonne(?string $dureePersonne): EntrepriseRequestDto
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
     * @return EntrepriseRequestDto
     */
    public function setIdentifiantCnps(?string $identifiantCnps): EntrepriseRequestDto
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
     * @return EntrepriseRequestDto
     */
    public function setNumeroContribuable(?string $numeroContribuable): EntrepriseRequestDto
    {
        $this->numeroContribuable = $numeroContribuable;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAdressePostale(): ?string
    {
        return $this->adressePostale;
    }

    /**
     * @param string|null $adressePostale
     * @return EntrepriseRequestDto
     */
    public function setAdressePostale(?string $adressePostale): EntrepriseRequestDto
    {
        $this->adressePostale = $adressePostale;
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
     * @return EntrepriseRequestDto
     */
    public function setTelephone(?string $telephone): EntrepriseRequestDto
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
     * @return EntrepriseRequestDto
     */
    public function setFax(?string $fax): EntrepriseRequestDto
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
     * @return EntrepriseRequestDto
     */
    public function setQuartier(?string $quartier): EntrepriseRequestDto
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
     * @return EntrepriseRequestDto
     */
    public function setVillage(?string $village): EntrepriseRequestDto
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
     * @return EntrepriseRequestDto
     */
    public function setLot(?string $lot): EntrepriseRequestDto
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
     * @return EntrepriseRequestDto
     */
    public function setIlot(?string $ilot): EntrepriseRequestDto
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
     * @return EntrepriseRequestDto
     */
    public function setEffectifSalarieHomme(?int $effectifSalarieHomme): EntrepriseRequestDto
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
     * @return EntrepriseRequestDto
     */
    public function setEffectifSalarieFemme(?int $effectifSalarieFemme): EntrepriseRequestDto
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
     * @return EntrepriseRequestDto
     */
    public function setEffectifApprentiHomme(?int $effectifApprentiHomme): EntrepriseRequestDto
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
     * @return EntrepriseRequestDto
     */
    public function setEffectifApprentiFemme(?int $effectifApprentiFemme): EntrepriseRequestDto
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
     * @return EntrepriseRequestDto
     */
    public function setLatitude(?string $latitude): EntrepriseRequestDto
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMontant(): ?int
    {
        return $this->montant;
    }

    /**
     * @param int|null $montant
     * @return EntrepriseRequestDto
     */
    public function setMontant(?int $montant): EntrepriseRequestDto
    {
        $this->montant = $montant;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumeroReferencePaiement(): ?string
    {
        return $this->numeroReferencePaiement;
    }

    /**
     * @param string|null $numeroReferencePaiement
     * @return EntrepriseRequestDto
     */
    public function setNumeroReferencePaiement(?string $numeroReferencePaiement): EntrepriseRequestDto
    {
        $this->numeroReferencePaiement = $numeroReferencePaiement;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumeroReferenceExterne(): ?string
    {
        return $this->numeroReferenceExterne;
    }

    /**
     * @param string|null $numeroReferenceExterne
     * @return EntrepriseRequestDto
     */
    public function setNumeroReferenceExterne(?string $numeroReferenceExterne): EntrepriseRequestDto
    {
        $this->numeroReferenceExterne = $numeroReferenceExterne;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCategoryArtisanCode(): ?string
    {
        return $this->categoryArtisanCode;
    }

    /**
     * @param string|null $categoryArtisanCode
     * @return EntrepriseRequestDto
     */
    public function setCategoryArtisanCode(?string $categoryArtisanCode): EntrepriseRequestDto
    {
        $this->categoryArtisanCode = $categoryArtisanCode;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateDebutActivite(): ?DateTimeInterface
    {
        return $this->dateDebutActivite;
    }

    /**
     * @param DateTimeInterface|null $dateDebutActivite
     * @return EntrepriseRequestDto
     */
    public function setDateDebutActivite(?DateTimeInterface $dateDebutActivite): EntrepriseRequestDto
    {
        $this->dateDebutActivite = $dateDebutActivite;
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
     * @return EntrepriseRequestDto
     */
    public function setLongitude(?string $longitude): EntrepriseRequestDto
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDepartmentCode(): ?string
    {
        return $this->departmentCode;
    }

    /**
     * @param string|null $departmentCode
     * @return EntrepriseRequestDto
     */
    public function setDepartmentCode(?string $departmentCode): EntrepriseRequestDto
    {
        $this->departmentCode = $departmentCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCommuneCode(): ?string
    {
        return $this->communeCode;
    }

    /**
     * @param string|null $communeCode
     * @return EntrepriseRequestDto
     */
    public function setCommuneCode(?string $communeCode): EntrepriseRequestDto
    {
        $this->communeCode = $communeCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCrmCode(): ?string
    {
        return $this->crmCode;
    }

    /**
     * @param string|null $crmCode
     * @return EntrepriseRequestDto
     */
    public function setCrmCode(?string $crmCode): EntrepriseRequestDto
    {
        $this->crmCode = $crmCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSousPrefectureCode(): ?string
    {
        return $this->sousPrefectureCode;
    }

    /**
     * @param string|null $sousPrefectureCode
     * @return EntrepriseRequestDto
     */
    public function setSousPrefectureCode(?string $sousPrefectureCode): EntrepriseRequestDto
    {
        $this->sousPrefectureCode = $sousPrefectureCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getVilleCode(): ?string
    {
        return $this->villeCode;
    }

    /**
     * @param string|null $villeCode
     * @return EntrepriseRequestDto
     */
    public function setVilleCode(?string $villeCode): EntrepriseRequestDto
    {
        $this->villeCode = $villeCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getActiviteCode(): ?string
    {
        return $this->activiteCode;
    }

    /**
     * @param string|null $activiteCode
     * @return EntrepriseRequestDto
     */
    public function setActiviteCode(?string $activiteCode): EntrepriseRequestDto
    {
        $this->activiteCode = $activiteCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGerantNom(): ?string
    {
        return $this->gerantNom;
    }

    /**
     * @param string|null $gerantNom
     * @return EntrepriseRequestDto
     */
    public function setGerantNom(?string $gerantNom): EntrepriseRequestDto
    {
        $this->gerantNom = $gerantNom;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGerantPrenoms(): ?string
    {
        return $this->gerantPrenoms;
    }

    /**
     * @param string|null $gerantPrenoms
     * @return EntrepriseRequestDto
     */
    public function setGerantPrenoms(?string $gerantPrenoms): EntrepriseRequestDto
    {
        $this->gerantPrenoms = $gerantPrenoms;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getGerantDateNaissance(): ?DateTimeInterface
    {
        return $this->gerantDateNaissance;
    }

    /**
     * @param DateTimeInterface|null $gerantDateNaissance
     * @return EntrepriseRequestDto
     */
    public function setGerantDateNaissance(?DateTimeInterface $gerantDateNaissance): EntrepriseRequestDto
    {
        $this->gerantDateNaissance = $gerantDateNaissance;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGerantLieuNaissance(): ?string
    {
        return $this->gerantLieuNaissance;
    }

    /**
     * @param string|null $gerantLieuNaissance
     * @return EntrepriseRequestDto
     */
    public function setGerantLieuNaissance(?string $gerantLieuNaissance): EntrepriseRequestDto
    {
        $this->gerantLieuNaissance = $gerantLieuNaissance;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGerantSexe(): ?string
    {
        return $this->gerantSexe;
    }

    /**
     * @param string|null $gerantSexe
     * @return EntrepriseRequestDto
     */
    public function setGerantSexe(?string $gerantSexe): EntrepriseRequestDto
    {
        $this->gerantSexe = $gerantSexe;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGerantDomicile(): ?string
    {
        return $this->gerantDomicile;
    }

    /**
     * @param string|null $gerantDomicile
     * @return EntrepriseRequestDto
     */
    public function setGerantDomicile(?string $gerantDomicile): EntrepriseRequestDto
    {
        $this->gerantDomicile = $gerantDomicile;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGerantQuartier(): ?string
    {
        return $this->gerantQuartier;
    }

    /**
     * @param string|null $gerantQuartier
     * @return EntrepriseRequestDto
     */
    public function setGerantQuartier(?string $gerantQuartier): EntrepriseRequestDto
    {
        $this->gerantQuartier = $gerantQuartier;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGerantTypePieceIdentite(): ?string
    {
        return $this->gerantTypePieceIdentite;
    }

    /**
     * @param string|null $gerantTypePieceIdentite
     * @return EntrepriseRequestDto
     */
    public function setGerantTypePieceIdentite(?string $gerantTypePieceIdentite): EntrepriseRequestDto
    {
        $this->gerantTypePieceIdentite = $gerantTypePieceIdentite;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGerantNumeroPieceIdentite(): ?string
    {
        return $this->gerantNumeroPieceIdentite;
    }

    /**
     * @param string|null $gerantNumeroPieceIdentite
     * @return EntrepriseRequestDto
     */
    public function setGerantNumeroPieceIdentite(?string $gerantNumeroPieceIdentite): EntrepriseRequestDto
    {
        $this->gerantNumeroPieceIdentite = $gerantNumeroPieceIdentite;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGerantLieuDelivrancePieceIdentite(): ?string
    {
        return $this->gerantLieuDelivrancePieceIdentite;
    }

    /**
     * @param string|null $gerantLieuDelivrancePieceIdentite
     * @return EntrepriseRequestDto
     */
    public function setGerantLieuDelivrancePieceIdentite(?string $gerantLieuDelivrancePieceIdentite): EntrepriseRequestDto
    {
        $this->gerantLieuDelivrancePieceIdentite = $gerantLieuDelivrancePieceIdentite;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getGerantDateDelivrancePieceIdentite(): ?DateTimeInterface
    {
        return $this->gerantDateDelivrancePieceIdentite;
    }

    /**
     * @param DateTimeInterface|null $gerantDateDelivrancePieceIdentite
     * @return EntrepriseRequestDto
     */
    public function setGerantDateDelivrancePieceIdentite(?DateTimeInterface $gerantDateDelivrancePieceIdentite): EntrepriseRequestDto
    {
        $this->gerantDateDelivrancePieceIdentite = $gerantDateDelivrancePieceIdentite;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGerantAutoriteDelivrancePieceIdentite(): ?string
    {
        return $this->gerantAutoriteDelivrancePieceIdentite;
    }

    /**
     * @param string|null $gerantAutoriteDelivrancePieceIdentite
     * @return EntrepriseRequestDto
     */
    public function setGerantAutoriteDelivrancePieceIdentite(?string $gerantAutoriteDelivrancePieceIdentite): EntrepriseRequestDto
    {
        $this->gerantAutoriteDelivrancePieceIdentite = $gerantAutoriteDelivrancePieceIdentite;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGerantEtatCivil(): ?string
    {
        return $this->gerantEtatCivil;
    }

    /**
     * @param string|null $gerantEtatCivil
     * @return EntrepriseRequestDto
     */
    public function setGerantEtatCivil(?string $gerantEtatCivil): EntrepriseRequestDto
    {
        $this->gerantEtatCivil = $gerantEtatCivil;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGerantReference(): ?string
    {
        return $this->gerantReference;
    }

    /**
     * @param string|null $gerantReference
     * @return EntrepriseRequestDto
     */
    public function setGerantReference(?string $gerantReference): EntrepriseRequestDto
    {
        $this->gerantReference = $gerantReference;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGerantVilleNaissanceCode(): ?string
    {
        return $this->gerantVilleNaissanceCode;
    }

    /**
     * @param string|null $gerantVilleNaissanceCode
     * @return EntrepriseRequestDto
     */
    public function setGerantVilleNaissanceCode(?string $gerantVilleNaissanceCode): EntrepriseRequestDto
    {
        $this->gerantVilleNaissanceCode = $gerantVilleNaissanceCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGerantPaysNaissanceCode(): ?string
    {
        return $this->gerantPaysNaissanceCode;
    }

    /**
     * @param string|null $gerantPaysNaissanceCode
     * @return EntrepriseRequestDto
     */
    public function setGerantPaysNaissanceCode(?string $gerantPaysNaissanceCode): EntrepriseRequestDto
    {
        $this->gerantPaysNaissanceCode = $gerantPaysNaissanceCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGerantNationaliteCode(): ?string
    {
        return $this->gerantNationaliteCode;
    }

    /**
     * @param string|null $gerantNationaliteCode
     * @return EntrepriseRequestDto
     */
    public function setGerantNationaliteCode(?string $gerantNationaliteCode): EntrepriseRequestDto
    {
        $this->gerantNationaliteCode = $gerantNationaliteCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGerantTelephone(): ?string
    {
        return $this->gerantTelephone;
    }

    /**
     * @param string|null $gerantTelephone
     * @return EntrepriseRequestDto
     */
    public function setGerantTelephone(?string $gerantTelephone): EntrepriseRequestDto
    {
        $this->gerantTelephone = $gerantTelephone;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGerantEmail(): ?string
    {
        return $this->gerantEmail;
    }

    /**
     * @param string|null $gerantEmail
     * @return EntrepriseRequestDto
     */
    public function setGerantEmail(?string $gerantEmail): EntrepriseRequestDto
    {
        $this->gerantEmail = $gerantEmail;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getScanDocument(): ?File
    {
        return $this->scanDocument;
    }

    /**
     * @param File|null $scanDocument
     * @return EntrepriseRequestDto
     */
    public function setScanDocument(?File $scanDocument): EntrepriseRequestDto
    {
        $this->scanDocument = $scanDocument;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTypeEnrolement(): ?string
    {
        return $this->typeEnrolement;
    }

    /**
     * @param string|null $typeEnrolement
     * @return EntrepriseRequestDto
     */
    public function setTypeEnrolement(?string $typeEnrolement): EntrepriseRequestDto
    {
        $this->typeEnrolement = $typeEnrolement;
        return $this;
    }

}
