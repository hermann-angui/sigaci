<?php

namespace App\DTO;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\Api\ArtisanImmatriculationController;
use App\State\ArtisanDtoStateProcessor;
use App\State\ArtisanDtoStateProvider;
use DateTimeInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    shortName: "Immatriculation Artisan",
    operations: [
        new Get(
            uriTemplate: '/artisan/{numeroImmatriculation}/immatriculation',
            input: ArtisanRequestDto::class,
            output: ArtisanRequestDto::class,
            provider: ArtisanDtoStateProvider::class,
            processor: ArtisanDtoStateProcessor::class,
        ),
        new Put(
            uriTemplate: '/artisan/{numeroImmatriculation}/immatriculation',
            input: ArtisanRequestDto::class,
            output: ArtisanRequestDto::class,
            provider: ArtisanDtoStateProvider::class,
            processor: ArtisanDtoStateProcessor::class,
        ),
        new Post(
            uriTemplate: '/artisan/immatriculation',
            inputFormats: ['multipart' => ['multipart/form-data']],
            controller: ArtisanImmatriculationController::class,
            input: ArtisanRequestDto::class,
            output: ArtisanResponseDto::class,
//            read: false,
//            deserialize: false,
//            validate: true,
//            write: false,
            provider: ArtisanDtoStateProvider::class,
            processor: ArtisanDtoStateProcessor::class,
            extraProperties: [
                'multipart' => true,
                'standard_put' => false,
                'rfc_7807_compliant_errors' => true
            ]
        ),
    ],
    //normalizationContext: ['groups' => ['artisan_dto:read']],
    //denormalizationContext: ['groups' => ['artisan_dto:create', 'artisan_dto:update']],
)]
class ArtisanRequestDto
{

    public ?string $id = null;                      // Peut être un string UUID ou int

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $email;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $nom;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $sexe;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $prenoms;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?DateTimeInterface $dateNaissance;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $lieuNaissance;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $domicile;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $quartier;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $typePieceIdentite;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $numeroPieceIdentite;

    #[Assert\NotNull()]
    #[Assert\File(
        maxSize: '10M',
        mimeTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/svg'],
    )]
    //#[Groups(['artisan_dto:create'])]
    private ?File $photo = null;

    #[Assert\File(
        maxSize: '10M',
        mimeTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/svg'],
    )]
    //#[Groups(['artisan_dto:create'])]
    private ?File $photoPieceIdentiteRecto = null;


    #[Assert\File(
        maxSize: '10M',
        mimeTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/svg'],
    )]
    //#[Groups(['artisan_dto:create'])]
    private ?File $photoPieceIdentiteVerso = null;

    #[Assert\File(
        maxSize: '10M',
        mimeTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/svg'],
    )]
    //#[Groups(['artisan_dto:create'])]
    private ?File $photoDocumentRecto = null;

    #[Assert\File(
        maxSize: '10M',
        mimeTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/svg'],
    )]
    //#[Groups(['artisan_dto:create'])]
    private ?File $photoDocumentVerso = null;


    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $lieuDelivrancePieceIdentite;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?DateTimeInterface $dateDelivrancePieceIdentite;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $autoriteDelivrancePieceIdentite;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $etatCivil;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $activiteExerceeLieu;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?DateTimeInterface $dateDebutActivite;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?DateTimeInterface $dateDebutActivitePro;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $telephone;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $whatsapp;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $codePostal;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $cnps;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $numeroRM;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $numeroCarteProfessionnelle;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $formationNiveauEtude;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $formationClasseEtude;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $formationDiplomeObtenu;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $formationApprentissageMetier;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $formationApprentissageMetierNiveau;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $formationApprentissageMetierDiplome;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $numeroPermisConduire;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $latitude;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $longitude;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?DateTimeInterface $created_at;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $crmCode;

    private ?int $montant;

    private ?int $code_paiement;

    private ?string $reference_externe;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $categoryArtisan;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $villeNaissanceCode;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $paysNaissanceCode;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $nationaliteCode;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $codeImmatriculation;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $codeIdentification;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $activiteSecondaireCode;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $activiteExerceeCode;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $activitePrincipaleCode;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $entrepriseNumeroIdentification;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $entrepriseNumeroImmatriculation;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $activiteCode;


    public function __construct(?string $id = null)
    {
        $this->id = $this->id ?? 'artisan_' . uniqid();
    }

    // Getters et setters...
    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return ArtisanRequestDto
     */
    public function setEmail(?string $email): ArtisanRequestDto
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string|null $nom
     * @return ArtisanRequestDto
     */
    public function setNom(?string $nom): ArtisanRequestDto
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    /**
     * @param string|null $sexe
     * @return ArtisanRequestDto
     */
    public function setSexe(?string $sexe): ArtisanRequestDto
    {
        $this->sexe = $sexe;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrenoms(): ?string
    {
        return $this->prenoms;
    }

    /**
     * @param string|null $prenoms
     * @return ArtisanRequestDto
     */
    public function setPrenoms(?string $prenoms): ArtisanRequestDto
    {
        $this->prenoms = $prenoms;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateNaissance(): ?DateTimeInterface
    {
        return $this->dateNaissance;
    }

    /**
     * @param DateTimeInterface|null $dateNaissance
     * @return ArtisanRequestDto
     */
    public function setDateNaissance(?DateTimeInterface $dateNaissance): ArtisanRequestDto
    {
        $this->dateNaissance = $dateNaissance;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLieuNaissance(): ?string
    {
        return $this->lieuNaissance;
    }

    /**
     * @param string|null $lieuNaissance
     * @return ArtisanRequestDto
     */
    public function setLieuNaissance(?string $lieuNaissance): ArtisanRequestDto
    {
        $this->lieuNaissance = $lieuNaissance;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDomicile(): ?string
    {
        return $this->domicile;
    }

    /**
     * @param string|null $domicile
     * @return ArtisanRequestDto
     */
    public function setDomicile(?string $domicile): ArtisanRequestDto
    {
        $this->domicile = $domicile;
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
     * @return ArtisanRequestDto
     */
    public function setQuartier(?string $quartier): ArtisanRequestDto
    {
        $this->quartier = $quartier;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTypePieceIdentite(): ?string
    {
        return $this->typePieceIdentite;
    }

    /**
     * @param string|null $typePieceIdentite
     * @return ArtisanRequestDto
     */
    public function setTypePieceIdentite(?string $typePieceIdentite): ArtisanRequestDto
    {
        $this->typePieceIdentite = $typePieceIdentite;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumeroPieceIdentite(): ?string
    {
        return $this->numeroPieceIdentite;
    }

    /**
     * @param string|null $numeroPieceIdentite
     * @return ArtisanRequestDto
     */
    public function setNumeroPieceIdentite(?string $numeroPieceIdentite): ArtisanRequestDto
    {
        $this->numeroPieceIdentite = $numeroPieceIdentite;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLieuDelivrancePieceIdentite(): ?string
    {
        return $this->lieuDelivrancePieceIdentite;
    }

    /**
     * @param string|null $lieuDelivrancePieceIdentite
     * @return ArtisanRequestDto
     */
    public function setLieuDelivrancePieceIdentite(?string $lieuDelivrancePieceIdentite): ArtisanRequestDto
    {
        $this->lieuDelivrancePieceIdentite = $lieuDelivrancePieceIdentite;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateDelivrancePieceIdentite(): ?DateTimeInterface
    {
        return $this->dateDelivrancePieceIdentite;
    }

    /**
     * @param DateTimeInterface|null $dateDelivrancePieceIdentite
     * @return ArtisanRequestDto
     */
    public function setDateDelivrancePieceIdentite(?DateTimeInterface $dateDelivrancePieceIdentite): ArtisanRequestDto
    {
        $this->dateDelivrancePieceIdentite = $dateDelivrancePieceIdentite;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAutoriteDelivrancePieceIdentite(): ?string
    {
        return $this->autoriteDelivrancePieceIdentite;
    }

    /**
     * @param string|null $autoriteDelivrancePieceIdentite
     * @return ArtisanRequestDto
     */
    public function setAutoriteDelivrancePieceIdentite(?string $autoriteDelivrancePieceIdentite): ArtisanRequestDto
    {
        $this->autoriteDelivrancePieceIdentite = $autoriteDelivrancePieceIdentite;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEtatCivil(): ?string
    {
        return $this->etatCivil;
    }

    /**
     * @param string|null $etatCivil
     * @return ArtisanRequestDto
     */
    public function setEtatCivil(?string $etatCivil): ArtisanRequestDto
    {
        $this->etatCivil = $etatCivil;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getActiviteExerceeLieu(): ?string
    {
        return $this->activiteExerceeLieu;
    }

    /**
     * @param string|null $activiteExerceeLieu
     * @return ArtisanRequestDto
     */
    public function setActiviteExerceeLieu(?string $activiteExerceeLieu): ArtisanRequestDto
    {
        $this->activiteExerceeLieu = $activiteExerceeLieu;
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
     * @return ArtisanRequestDto
     */
    public function setDateDebutActivite(?DateTimeInterface $dateDebutActivite): ArtisanRequestDto
    {
        $this->dateDebutActivite = $dateDebutActivite;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateDebutActivitePro(): ?DateTimeInterface
    {
        return $this->dateDebutActivitePro;
    }

    /**
     * @param DateTimeInterface|null $dateDebutActivitePro
     * @return ArtisanRequestDto
     */
    public function setDateDebutActivitePro(?DateTimeInterface $dateDebutActivitePro): ArtisanRequestDto
    {
        $this->dateDebutActivitePro = $dateDebutActivitePro;
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
     * @return ArtisanRequestDto
     */
    public function setTelephone(?string $telephone): ArtisanRequestDto
    {
        $this->telephone = $telephone;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWhatsapp(): ?string
    {
        return $this->whatsapp;
    }

    /**
     * @param string|null $whatsapp
     * @return ArtisanRequestDto
     */
    public function setWhatsapp(?string $whatsapp): ArtisanRequestDto
    {
        $this->whatsapp = $whatsapp;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    /**
     * @param string|null $codePostal
     * @return ArtisanRequestDto
     */
    public function setCodePostal(?string $codePostal): ArtisanRequestDto
    {
        $this->codePostal = $codePostal;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCnps(): ?string
    {
        return $this->cnps;
    }

    /**
     * @param string|null $cnps
     * @return ArtisanRequestDto
     */
    public function setCnps(?string $cnps): ArtisanRequestDto
    {
        $this->cnps = $cnps;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumeroRM(): ?string
    {
        return $this->numeroRM;
    }

    /**
     * @param string|null $numeroRM
     * @return ArtisanRequestDto
     */
    public function setNumeroRM(?string $numeroRM): ArtisanRequestDto
    {
        $this->numeroRM = $numeroRM;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumeroCarteProfessionnelle(): ?string
    {
        return $this->numeroCarteProfessionnelle;
    }

    /**
     * @param string|null $numeroCarteProfessionnelle
     * @return ArtisanRequestDto
     */
    public function setNumeroCarteProfessionnelle(?string $numeroCarteProfessionnelle): ArtisanRequestDto
    {
        $this->numeroCarteProfessionnelle = $numeroCarteProfessionnelle;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFormationNiveauEtude(): ?string
    {
        return $this->formationNiveauEtude;
    }

    /**
     * @param string|null $formationNiveauEtude
     * @return ArtisanRequestDto
     */
    public function setFormationNiveauEtude(?string $formationNiveauEtude): ArtisanRequestDto
    {
        $this->formationNiveauEtude = $formationNiveauEtude;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFormationClasseEtude(): ?string
    {
        return $this->formationClasseEtude;
    }

    /**
     * @param string|null $formationClasseEtude
     * @return ArtisanRequestDto
     */
    public function setFormationClasseEtude(?string $formationClasseEtude): ArtisanRequestDto
    {
        $this->formationClasseEtude = $formationClasseEtude;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFormationDiplomeObtenu(): ?string
    {
        return $this->formationDiplomeObtenu;
    }

    /**
     * @param string|null $formationDiplomeObtenu
     * @return ArtisanRequestDto
     */
    public function setFormationDiplomeObtenu(?string $formationDiplomeObtenu): ArtisanRequestDto
    {
        $this->formationDiplomeObtenu = $formationDiplomeObtenu;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFormationApprentissageMetier(): ?string
    {
        return $this->formationApprentissageMetier;
    }

    /**
     * @param string|null $formationApprentissageMetier
     * @return ArtisanRequestDto
     */
    public function setFormationApprentissageMetier(?string $formationApprentissageMetier): ArtisanRequestDto
    {
        $this->formationApprentissageMetier = $formationApprentissageMetier;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFormationApprentissageMetierNiveau(): ?string
    {
        return $this->formationApprentissageMetierNiveau;
    }

    /**
     * @param string|null $formationApprentissageMetierNiveau
     * @return ArtisanRequestDto
     */
    public function setFormationApprentissageMetierNiveau(?string $formationApprentissageMetierNiveau): ArtisanRequestDto
    {
        $this->formationApprentissageMetierNiveau = $formationApprentissageMetierNiveau;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFormationApprentissageMetierDiplome(): ?string
    {
        return $this->formationApprentissageMetierDiplome;
    }

    /**
     * @param string|null $formationApprentissageMetierDiplome
     * @return ArtisanRequestDto
     */
    public function setFormationApprentissageMetierDiplome(?string $formationApprentissageMetierDiplome): ArtisanRequestDto
    {
        $this->formationApprentissageMetierDiplome = $formationApprentissageMetierDiplome;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumeroPermisConduire(): ?string
    {
        return $this->numeroPermisConduire;
    }

    /**
     * @param string|null $numeroPermisConduire
     * @return ArtisanRequestDto
     */
    public function setNumeroPermisConduire(?string $numeroPermisConduire): ArtisanRequestDto
    {
        $this->numeroPermisConduire = $numeroPermisConduire;
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
     * @return ArtisanRequestDto
     */
    public function setLatitude(?string $latitude): ArtisanRequestDto
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
     * @return ArtisanRequestDto
     */
    public function setLongitude(?string $longitude): ArtisanRequestDto
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->created_at;
    }

    /**
     * @param DateTimeInterface|null $created_at
     * @return ArtisanRequestDto
     */
    public function setCreatedAt(?DateTimeInterface $created_at): ArtisanRequestDto
    {
        $this->created_at = $created_at;
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
     * @return ArtisanRequestDto
     */
    public function setCrmCode(?string $crmCode): ArtisanRequestDto
    {
        $this->crmCode = $crmCode;
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
     * @return ArtisanRequestDto
     */
    public function setMontant(?int $montant): ArtisanRequestDto
    {
        $this->montant = $montant;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCodePaiement(): ?int
    {
        return $this->code_paiement;
    }

    /**
     * @param int|null $code_paiement
     * @return ArtisanRequestDto
     */
    public function setCodePaiement(?int $code_paiement): ArtisanRequestDto
    {
        $this->code_paiement = $code_paiement;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getReferenceExterne(): ?string
    {
        return $this->reference_externe;
    }

    /**
     * @param string|null $reference_externe
     * @return ArtisanRequestDto
     */
    public function setReferenceExterne(?string $reference_externe): ArtisanRequestDto
    {
        $this->reference_externe = $reference_externe;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCategoryArtisan(): ?string
    {
        return $this->categoryArtisan;
    }

    /**
     * @param string|null $categoryArtisan
     * @return ArtisanRequestDto
     */
    public function setCategoryArtisan(?string $categoryArtisan): ArtisanRequestDto
    {
        $this->categoryArtisan = $categoryArtisan;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getVilleNaissanceCode(): ?string
    {
        return $this->villeNaissanceCode;
    }

    /**
     * @param string|null $villeNaissanceCode
     * @return ArtisanRequestDto
     */
    public function setVilleNaissanceCode(?string $villeNaissanceCode): ArtisanRequestDto
    {
        $this->villeNaissanceCode = $villeNaissanceCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaysNaissanceCode(): ?string
    {
        return $this->paysNaissanceCode;
    }

    /**
     * @param string|null $paysNaissanceCode
     * @return ArtisanRequestDto
     */
    public function setPaysNaissanceCode(?string $paysNaissanceCode): ArtisanRequestDto
    {
        $this->paysNaissanceCode = $paysNaissanceCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNationaliteCode(): ?string
    {
        return $this->nationaliteCode;
    }

    /**
     * @param string|null $nationaliteCode
     * @return ArtisanRequestDto
     */
    public function setNationaliteCode(?string $nationaliteCode): ArtisanRequestDto
    {
        $this->nationaliteCode = $nationaliteCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCodeImmatriculation(): ?string
    {
        return $this->codeImmatriculation;
    }

    /**
     * @param string|null $codeImmatriculation
     * @return ArtisanRequestDto
     */
    public function setCodeImmatriculation(?string $codeImmatriculation): ArtisanRequestDto
    {
        $this->codeImmatriculation = $codeImmatriculation;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCodeIdentification(): ?string
    {
        return $this->codeIdentification;
    }

    /**
     * @param string|null $codeIdentification
     * @return ArtisanRequestDto
     */
    public function setCodeIdentification(?string $codeIdentification): ArtisanRequestDto
    {
        $this->codeIdentification = $codeIdentification;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getActiviteSecondaireCode(): ?string
    {
        return $this->activiteSecondaireCode;
    }

    /**
     * @param string|null $activiteSecondaireCode
     * @return ArtisanRequestDto
     */
    public function setActiviteSecondaireCode(?string $activiteSecondaireCode): ArtisanRequestDto
    {
        $this->activiteSecondaireCode = $activiteSecondaireCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getActiviteExerceeCode(): ?string
    {
        return $this->activiteExerceeCode;
    }

    /**
     * @param string|null $activiteExerceeCode
     * @return ArtisanRequestDto
     */
    public function setActiviteExerceeCode(?string $activiteExerceeCode): ArtisanRequestDto
    {
        $this->activiteExerceeCode = $activiteExerceeCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getActivitePrincipaleCode(): ?string
    {
        return $this->activitePrincipaleCode;
    }

    /**
     * @param string|null $activitePrincipaleCode
     * @return ArtisanRequestDto
     */
    public function setActivitePrincipaleCode(?string $activitePrincipaleCode): ArtisanRequestDto
    {
        $this->activitePrincipaleCode = $activitePrincipaleCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEntrepriseNumeroIdentification(): ?string
    {
        return $this->entrepriseNumeroIdentification;
    }

    /**
     * @param string|null $entrepriseNumeroIdentification
     * @return ArtisanRequestDto
     */
    public function setEntrepriseNumeroIdentification(?string $entrepriseNumeroIdentification): ArtisanRequestDto
    {
        $this->entrepriseNumeroIdentification = $entrepriseNumeroIdentification;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEntrepriseNumeroImmatriculation(): ?string
    {
        return $this->entrepriseNumeroImmatriculation;
    }

    /**
     * @param string|null $entrepriseNumeroImmatriculation
     * @return ArtisanRequestDto
     */
    public function setEntrepriseNumeroImmatriculation(?string $entrepriseNumeroImmatriculation): ArtisanRequestDto
    {
        $this->entrepriseNumeroImmatriculation = $entrepriseNumeroImmatriculation;
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
     * @return ArtisanRequestDto
     */
    public function setActiviteCode(?string $activiteCode): ArtisanRequestDto
    {
        $this->activiteCode = $activiteCode;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getPhoto(): ?File
    {
        return $this->photo;
    }

    /**
     * @param File|null $photo
     * @return ArtisanRequestDto
     */
    public function setPhoto(?File $photo): ArtisanRequestDto
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getPhotoPieceIdentiteRecto(): ?File
    {
        return $this->photoPieceIdentiteRecto;
    }

    /**
     * @param File|null $photoPieceIdentiteRecto
     * @return ArtisanRequestDto
     */
    public function setPhotoPieceIdentiteRecto(?File $photoPieceIdentiteRecto): ArtisanRequestDto
    {
        $this->photoPieceIdentiteRecto = $photoPieceIdentiteRecto;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getPhotoPieceIdentiteVerso(): ?File
    {
        return $this->photoPieceIdentiteVerso;
    }

    /**
     * @param File|null $photoPieceIdentiteVerso
     * @return ArtisanRequestDto
     */
    public function setPhotoPieceIdentiteVerso(?File $photoPieceIdentiteVerso): ArtisanRequestDto
    {
        $this->photoPieceIdentiteVerso = $photoPieceIdentiteVerso;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getPhotoDocumentRecto(): ?File
    {
        return $this->photoDocumentRecto;
    }

    /**
     * @param File|null $photoDocumentRecto
     * @return ArtisanRequestDto
     */
    public function setPhotoDocumentRecto(?File $photoDocumentRecto): ArtisanRequestDto
    {
        $this->photoDocumentRecto = $photoDocumentRecto;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getPhotoDocumentVerso(): ?File
    {
        return $this->photoDocumentVerso;
    }

    /**
     * @param File|null $photoDocumentVerso
     * @return ArtisanRequestDto
     */
    public function setPhotoDocumentVerso(?File $photoDocumentVerso): ArtisanRequestDto
    {
        $this->photoDocumentVerso = $photoDocumentVerso;
        return $this;
    }

}
