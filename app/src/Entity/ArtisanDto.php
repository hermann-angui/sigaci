<?php

namespace App\Entity;

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
            input: ArtisanDto::class,
            output: ArtisanDto::class,
            provider: ArtisanDtoStateProvider::class,
            processor: ArtisanDtoStateProcessor::class,
        ),
        new Put(
            uriTemplate: '/artisan/{numeroImmatriculation}/immatriculation',
            input: ArtisanDto::class,
            output: ArtisanDto::class,
            provider: ArtisanDtoStateProvider::class,
            processor: ArtisanDtoStateProcessor::class,
        ),
        new Post(
            uriTemplate: '/artisan/immatriculation',
            inputFormats: ['multipart' => ['multipart/form-data']],
            controller: ArtisanImmatriculationController::class,
            input: ArtisanDto::class,
            output: ArtisanDto::class,
            read: false,
            deserialize: false,
            validate: true,
            write: false,
            provider: ArtisanDtoStateProvider::class,
            processor: ArtisanDtoStateProcessor::class,
            // processor: DocumentProcessor::class,
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
class ArtisanDto
{

    public ?string $id = null; // Peut être un string UUID ou int

   // #[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $email;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $nom;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $sexe;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $prenoms;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?DateTimeInterface $dateNaissance;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $lieuNaissance;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $domicile;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $quartier;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $typePieceIdentite;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $numeroPieceIdentite;

    #[Assert\NotNull()]
    #[Assert\File(
        maxSize: '10M',
        mimeTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/svg'],
    )]
    private ?File $photo = null;

    #[Assert\NotNull()]
    #[Assert\File(
        maxSize: '10M',
        mimeTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/svg'],
    )]
    private ?File $photoPieceIdentiteRecto = null;


    #[Assert\NotNull()]
    #[Assert\File(
        maxSize: '10M',
        mimeTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/svg'],
    )]
    private ?File $photoPieceIdentiteVerso = null;

    #[Assert\NotNull()]
    #[Assert\File(
        maxSize: '10M',
        mimeTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/svg'],
    )]
    private ?File $photoDocumentRecto = null;

    #[Assert\NotNull()]
    #[Assert\File(
        maxSize: '10M',
        mimeTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/svg'],
    )]
    private ?File $photoDocumentVerso = null;


    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $lieuDelivrancePieceIdentite;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?DateTimeInterface $dateDelivrancePieceIdentite;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $autoriteDelivrancePieceIdentite;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $etatCivil;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $activiteExerceeLieu;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?DateTimeInterface $dateDebutActivite;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?DateTimeInterface $dateDebutActivitePro;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $telephone;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $whatsapp;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $codePostal;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $cnps;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $numeroRM;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $numeroCarteProfessionnelle;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $formationNiveauEtude;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $formationClasseEtude;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $formationDiplomeObtenu;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $formationApprentissageMetier;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $formationApprentissageMetierNiveau;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $formationApprentissageMetierDiplome;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $numeroPermisConduire;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $latitude;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $longitude;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?DateTimeInterface $created_at;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $crmId;

    private ?int $montant;

    private ?int $code_paiement;

    private ?string $reference_externe;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $categoryArtisan;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $villeNaissanceId;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $paysNaissanceId;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $nationaliteId;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $codeImmatriculation;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $codeIdentification;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $activiteSecondaireId;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $activiteExerceeId;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $activitePrincipaleId;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $entrepriseNumeroIdentification;

    private ?string $entrepriseNumeroImmatriculation;

    //#[Groups(['artisan_dto:read', 'artisan_dto:write'])]
    private ?string $activiteId;


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
     * @return ArtisanDto
     */
    public function setEmail(?string $email): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setNom(?string $nom): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setSexe(?string $sexe): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setPrenoms(?string $prenoms): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setDateNaissance(?DateTimeInterface $dateNaissance): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setLieuNaissance(?string $lieuNaissance): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setDomicile(?string $domicile): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setQuartier(?string $quartier): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setTypePieceIdentite(?string $typePieceIdentite): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setNumeroPieceIdentite(?string $numeroPieceIdentite): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setLieuDelivrancePieceIdentite(?string $lieuDelivrancePieceIdentite): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setDateDelivrancePieceIdentite(?DateTimeInterface $dateDelivrancePieceIdentite): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setAutoriteDelivrancePieceIdentite(?string $autoriteDelivrancePieceIdentite): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setEtatCivil(?string $etatCivil): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setActiviteExerceeLieu(?string $activiteExerceeLieu): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setDateDebutActivite(?DateTimeInterface $dateDebutActivite): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setDateDebutActivitePro(?DateTimeInterface $dateDebutActivitePro): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setTelephone(?string $telephone): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setWhatsapp(?string $whatsapp): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setCodePostal(?string $codePostal): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setCnps(?string $cnps): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setNumeroRM(?string $numeroRM): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setNumeroCarteProfessionnelle(?string $numeroCarteProfessionnelle): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setFormationNiveauEtude(?string $formationNiveauEtude): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setFormationClasseEtude(?string $formationClasseEtude): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setFormationDiplomeObtenu(?string $formationDiplomeObtenu): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setFormationApprentissageMetier(?string $formationApprentissageMetier): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setFormationApprentissageMetierNiveau(?string $formationApprentissageMetierNiveau): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setFormationApprentissageMetierDiplome(?string $formationApprentissageMetierDiplome): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setNumeroPermisConduire(?string $numeroPermisConduire): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setLatitude(?string $latitude): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setLongitude(?string $longitude): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setCreatedAt(?DateTimeInterface $created_at): ArtisanDto
    {
        $this->created_at = $created_at;
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
     * @return ArtisanDto
     */
    public function setCrmId(?string $crmId): ArtisanDto
    {
        $this->crmId = $crmId;
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
     * @return ArtisanDto
     */
    public function setMontant(?int $montant): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setCodePaiement(?int $code_paiement): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setReferenceExterne(?string $reference_externe): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setCategoryArtisan(?string $categoryArtisan): ArtisanDto
    {
        $this->categoryArtisan = $categoryArtisan;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getVilleNaissanceId(): ?string
    {
        return $this->villeNaissanceId;
    }

    /**
     * @param string|null $villeNaissanceId
     * @return ArtisanDto
     */
    public function setVilleNaissanceId(?string $villeNaissanceId): ArtisanDto
    {
        $this->villeNaissanceId = $villeNaissanceId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaysNaissanceId(): ?string
    {
        return $this->paysNaissanceId;
    }

    /**
     * @param string|null $paysNaissanceId
     * @return ArtisanDto
     */
    public function setPaysNaissanceId(?string $paysNaissanceId): ArtisanDto
    {
        $this->paysNaissanceId = $paysNaissanceId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNationaliteId(): ?string
    {
        return $this->nationaliteId;
    }

    /**
     * @param string|null $nationaliteId
     * @return ArtisanDto
     */
    public function setNationaliteId(?string $nationaliteId): ArtisanDto
    {
        $this->nationaliteId = $nationaliteId;
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
     * @return ArtisanDto
     */
    public function setCodeImmatriculation(?string $codeImmatriculation): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setCodeIdentification(?string $codeIdentification): ArtisanDto
    {
        $this->codeIdentification = $codeIdentification;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getActiviteSecondaireId(): ?string
    {
        return $this->activiteSecondaireId;
    }

    /**
     * @param string|null $activiteSecondaireId
     * @return ArtisanDto
     */
    public function setActiviteSecondaireId(?string $activiteSecondaireId): ArtisanDto
    {
        $this->activiteSecondaireId = $activiteSecondaireId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getActiviteExerceeId(): ?string
    {
        return $this->activiteExerceeId;
    }

    /**
     * @param string|null $activiteExerceeId
     * @return ArtisanDto
     */
    public function setActiviteExerceeId(?string $activiteExerceeId): ArtisanDto
    {
        $this->activiteExerceeId = $activiteExerceeId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getActivitePrincipaleId(): ?string
    {
        return $this->activitePrincipaleId;
    }

    /**
     * @param string|null $activitePrincipaleId
     * @return ArtisanDto
     */
    public function setActivitePrincipaleId(?string $activitePrincipaleId): ArtisanDto
    {
        $this->activitePrincipaleId = $activitePrincipaleId;
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
     * @return ArtisanDto
     */
    public function setEntrepriseNumeroIdentification(?string $entrepriseNumeroIdentification): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setEntrepriseNumeroImmatriculation(?string $entrepriseNumeroImmatriculation): ArtisanDto
    {
        $this->entrepriseNumeroImmatriculation = $entrepriseNumeroImmatriculation;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getActiviteId(): ?string
    {
        return $this->activiteId;
    }

    /**
     * @param string|null $activiteId
     * @return ArtisanDto
     */
    public function setActiviteId(?string $activiteId): ArtisanDto
    {
        $this->activiteId = $activiteId;
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
     * @return ArtisanDto
     */
    public function setPhoto(?File $photo): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setPhotoPieceIdentiteRecto(?File $photoPieceIdentiteRecto): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setPhotoPieceIdentiteVerso(?File $photoPieceIdentiteVerso): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setPhotoDocumentRecto(?File $photoDocumentRecto): ArtisanDto
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
     * @return ArtisanDto
     */
    public function setPhotoDocumentVerso(?File $photoDocumentVerso): ArtisanDto
    {
        $this->photoDocumentVerso = $photoDocumentVerso;
        return $this;
    }

}
