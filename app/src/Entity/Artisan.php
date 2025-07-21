<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ArtisanRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtisanRepository::class)]
#[ORM\Table(name: '`artisans`')]
#[ORM\HasLifecycleCallbacks]
#[ApiResource()]
class Artisan
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: MediaObject::class)]
    #[ORM\JoinColumn(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/image'], writable: false)]
    public ?MediaObject $photo = null;

    #[ORM\Column(length: 255, unique: true, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sexe;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenoms;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $dateNaissance;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lieuNaissance;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $domicile;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $quartier;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $typePieceIdentite;

    #[ORM\Column(length: 255,unique: true, nullable: true)]
    private ?string $numeroPieceIdentite;

    #[ORM\ManyToOne(targetEntity: MediaObject::class)]
    #[ORM\JoinColumn(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/image'], writable: false)]
    public ?MediaObject $photoPieceIdentiteRecto;

    #[ORM\ManyToOne(targetEntity: MediaObject::class)]
    #[ORM\JoinColumn(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/image'], writable: false)]
    public ?MediaObject $photoPieceIdentiteVerso;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lieuDelivrancePieceIdentite;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $dateDelivrancePieceIdentite;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $autoriteDelivrancePieceIdentite;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $etatCivil;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $activiteExerceeLieu;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $dateDebutActivite;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $dateDebutActivitePro;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telephone;

    #[ORM\Column(length: 255, unique: true, nullable: true)]
    private ?string $whatsapp;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $codePostal;

    #[ORM\Column(length: 255,unique: true, nullable: true)]
    private ?string $cnps;

    #[ORM\Column(length: 255, unique: true, nullable: true)]
    private ?string $numeroRM;

    #[ORM\Column(length: 255, unique: true, nullable: true)]
    private ?string $numeroCarteProfessionnelle;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomConjoint;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenomsConjoint;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomUrgence;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenomsUrgence;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telephoneUrgence;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $formationNiveauEtude;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $formationClasseEtude;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $formationDiplomeObtenu;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $formationApprentissageMetier;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $formationApprentissageMetierNiveau;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $formationApprentissageMetierDiplome;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numeroPermisConduire;

    #[ORM\ManyToOne(targetEntity: MediaObject::class)]
    #[ORM\JoinColumn(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/image'], writable: false)]
    public ?MediaObject $photoPermisVerso;

    #[ORM\ManyToOne(targetEntity: MediaObject::class)]
    #[ORM\JoinColumn(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/image'], writable: false)]
    public ?MediaObject $photoPermisRecto;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $latitude;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $longitude;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $created_at;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $modified_at;

    #[ORM\ManyToOne(inversedBy: 'artisans')]
    private ?Crm $crm = null;

    #[ORM\ManyToOne(inversedBy: 'artisans')]
    private ?Etablissement $etablissement = null;

    #[ORM\OneToOne(targetEntity: self::class)]
    private ?self $patron = null;


    #[ORM\ManyToOne(inversedBy: 'artisans')]
    private ?CategoryArtisan $categoryArtisan = null;

    #[ORM\ManyToOne(inversedBy: 'artisans')]
    private ?Villes $villeNaissance = null;

    #[ORM\ManyToOne(inversedBy: 'artisans')]
    private ?Pays $paysNaissance = null;

    #[ORM\ManyToOne(inversedBy: 'artisans')]
    private ?Pays $nationalite = null;

    #[ORM\OneToOne()]
    private ?Immatriculation $immatriculation = null;

    #[ORM\OneToOne()]
    private ?Identification $identification = null;

    #[ORM\ManyToOne]
    private ?Metiers $activiteSecondaire = null;

    #[ORM\ManyToOne]
    private ?Metiers $activiteExercee = null;

    #[ORM\ManyToOne(inversedBy: 'artisanActvitePrincipales')]
    private ?Metiers $activitePrincipale = null;

    public function __construct()
    {
        $this->created_at = new DateTime();
        $this->modified_at = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getCrm(): ?Crm
    {
        return $this->crm;
    }

    public function setCrm(?Crm $crm): self
    {
        $this->crm = $crm;
        return $this;
    }

    public function getEtablissement(): ?Etablissement
    {
        return $this->etablissement;
    }

    public function setEtablissement(?Etablissement $etablissement): self
    {
        $this->etablissement = $etablissement;
        return $this;
    }

    public function getPatron(): ?self
    {
        return $this->patron;
    }

    public function setPatron(?self $patron): self
    {
        $this->patron = $patron;

        return $this;
    }

    /**
     * @return MediaObject|null
     */
    public function getPhoto(): ?MediaObject
    {
        return $this->photo;
    }

    /**
     * @param MediaObject|null $photo
     * @return Artisan
     */
    public function setPhoto(?MediaObject $photo): Artisan
    {
        $this->photo = $photo;
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
     * @return Artisan
     */
    public function setNom(?string $nom): Artisan
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
     * @return Artisan
     */
    public function setSexe(?string $sexe): Artisan
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
     * @return Artisan
     */
    public function setPrenoms(?string $prenoms): Artisan
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
     * @return Artisan
     */
    public function setDateNaissance(?DateTimeInterface $dateNaissance): Artisan
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
     * @return Artisan
     */
    public function setLieuNaissance(?string $lieuNaissance): Artisan
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
     * @return Artisan
     */
    public function setDomicile(?string $domicile): Artisan
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
     * @return Artisan
     */
    public function setQuartier(?string $quartier): Artisan
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
     * @return Artisan
     */
    public function setTypePieceIdentite(?string $typePieceIdentite): Artisan
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
     * @return Artisan
     */
    public function setNumeroPieceIdentite(?string $numeroPieceIdentite): Artisan
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
     * @return Artisan
     */
    public function setLieuDelivrancePieceIdentite(?string $lieuDelivrancePieceIdentite): Artisan
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
     * @return Artisan
     */
    public function setDateDelivrancePieceIdentite(?DateTimeInterface $dateDelivrancePieceIdentite): Artisan
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
     * @return Artisan
     */
    public function setAutoriteDelivrancePieceIdentite(?string $autoriteDelivrancePieceIdentite): Artisan
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
     * @return Artisan
     */
    public function setEtatCivil(?string $etatCivil): Artisan
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
     * @return Artisan
     */
    public function setActiviteExerceeLieu(?string $activiteExerceeLieu): Artisan
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
     * @return Artisan
     */
    public function setDateDebutActivite(?DateTimeInterface $dateDebutActivite): Artisan
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
     * @return Artisan
     */
    public function setDateDebutActivitePro(?DateTimeInterface $dateDebutActivitePro): Artisan
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
     * @return Artisan
     */
    public function setTelephone(?string $telephone): Artisan
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
     * @return Artisan
     */
    public function setWhatsapp(?string $whatsapp): Artisan
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
     * @return Artisan
     */
    public function setCodePostal(?string $codePostal): Artisan
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
     * @return Artisan
     */
    public function setCnps(?string $cnps): Artisan
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
     * @return Artisan
     */
    public function setNumeroRM(?string $numeroRM): Artisan
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
     * @return Artisan
     */
    public function setNumeroCarteProfessionnelle(?string $numeroCarteProfessionnelle): Artisan
    {
        $this->numeroCarteProfessionnelle = $numeroCarteProfessionnelle;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNomConjoint(): ?string
    {
        return $this->nomConjoint;
    }

    /**
     * @param string|null $nomConjoint
     * @return Artisan
     */
    public function setNomConjoint(?string $nomConjoint): Artisan
    {
        $this->nomConjoint = $nomConjoint;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrenomsConjoint(): ?string
    {
        return $this->prenomsConjoint;
    }

    /**
     * @param string|null $prenomsConjoint
     * @return Artisan
     */
    public function setPrenomsConjoint(?string $prenomsConjoint): Artisan
    {
        $this->prenomsConjoint = $prenomsConjoint;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNomUrgence(): ?string
    {
        return $this->nomUrgence;
    }

    /**
     * @param string|null $nomUrgence
     * @return Artisan
     */
    public function setNomUrgence(?string $nomUrgence): Artisan
    {
        $this->nomUrgence = $nomUrgence;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrenomsUrgence(): ?string
    {
        return $this->prenomsUrgence;
    }

    /**
     * @param string|null $prenomsUrgence
     * @return Artisan
     */
    public function setPrenomsUrgence(?string $prenomsUrgence): Artisan
    {
        $this->prenomsUrgence = $prenomsUrgence;
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
     * @return Artisan
     */
    public function setFormationNiveauEtude(?string $formationNiveauEtude): Artisan
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
     * @return Artisan
     */
    public function setFormationClasseEtude(?string $formationClasseEtude): Artisan
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
     * @return Artisan
     */
    public function setFormationDiplomeObtenu(?string $formationDiplomeObtenu): Artisan
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
     * @return Artisan
     */
    public function setFormationApprentissageMetier(?string $formationApprentissageMetier): Artisan
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
     * @return Artisan
     */
    public function setFormationApprentissageMetierNiveau(?string $formationApprentissageMetierNiveau): Artisan
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
     * @return Artisan
     */
    public function setFormationApprentissageMetierDiplome(?string $formationApprentissageMetierDiplome): Artisan
    {
        $this->formationApprentissageMetierDiplome = $formationApprentissageMetierDiplome;
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
     * @return Artisan
     */
    public function setLatitude(?string $latitude): Artisan
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
     * @return Artisan
     */
    public function setLongitude(?string $longitude): Artisan
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
     * @return Artisan
     */
    public function setCreatedAt(?DateTimeInterface $created_at): Artisan
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getModifiedAt(): ?DateTimeInterface
    {
        return $this->modified_at;
    }

    /**
     * @param DateTimeInterface|null $modified_at
     * @return Artisan
     */
    public function setModifiedAt(?DateTimeInterface $modified_at): Artisan
    {
        $this->modified_at = $modified_at;
        return $this;
    }

    public function getCategoryArtisan(): ?CategoryArtisan
    {
        return $this->categoryArtisan;
    }

    public function setCategoryArtisan(?CategoryArtisan $categoryArtisan): static
    {
        $this->categoryArtisan = $categoryArtisan;

        return $this;
    }

    public function getVilleNaissance(): ?Villes
    {
        return $this->villeNaissance;
    }

    public function setVilleNaissance(?Villes $villeNaissance): static
    {
        $this->villeNaissance = $villeNaissance;

        return $this;
    }

    public function getPaysNaissance(): ?Pays
    {
        return $this->paysNaissance;
    }

    public function setPaysNaissance(?Pays $paysNaissance): static
    {
        $this->paysNaissance = $paysNaissance;

        return $this;
    }

    public function getNationalite(): ?Pays
    {
        return $this->nationalite;
    }

    public function setNationalite(?Pays $nationalite): static
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getImmatriculation(): ?Immatriculation
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(?Immatriculation $immatriculation): static
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    public function getIdentification(): ?Identification
    {
        return $this->identification;
    }

    public function setIdentification(?Identification $identification): static
    {
        $this->identification = $identification;

        return $this;
    }

    public function getActiviteSecondaire(): ?Metiers
    {
        return $this->activiteSecondaire;
    }

    public function setActiviteSecondaire(?Metiers $activiteSecondaire): static
    {
        $this->activiteSecondaire = $activiteSecondaire;

        return $this;
    }

    public function getActiviteExercee(): ?Metiers
    {
        return $this->activiteExercee;
    }

    public function setActiviteExercee(?Metiers $activiteExercee): static
    {
        $this->activiteExercee = $activiteExercee;

        return $this;
    }

    public function getActivitePrincipale(): ?Metiers
    {
        return $this->activitePrincipale;
    }

    public function setActivitePrincipale(?Metiers $activitePrincipale): static
    {
        $this->activitePrincipale = $activitePrincipale;

        return $this;
    }

    /**
     * @return MediaObject|null
     */
    public function getPhotoPieceIdentiteRecto(): ?MediaObject
    {
        return $this->photoPieceIdentiteRecto;
    }

    /**
     * @param MediaObject|null $photoPieceIdentiteRecto
     * @return Artisan
     */
    public function setPhotoPieceIdentiteRecto(?MediaObject $photoPieceIdentiteRecto): Artisan
    {
        $this->photoPieceIdentiteRecto = $photoPieceIdentiteRecto;
        return $this;
    }

    /**
     * @return MediaObject|null
     */
    public function getPhotoPieceIdentiteVerso(): ?MediaObject
    {
        return $this->photoPieceIdentiteVerso;
    }

    /**
     * @param MediaObject|null $photoPieceIdentiteVerso
     * @return Artisan
     */
    public function setPhotoPieceIdentiteVerso(?MediaObject $photoPieceIdentiteVerso): Artisan
    {
        $this->photoPieceIdentiteVerso = $photoPieceIdentiteVerso;
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
     * @return Artisan
     */
    public function setNumeroPermisConduire(?string $numeroPermisConduire): Artisan
    {
        $this->numeroPermisConduire = $numeroPermisConduire;
        return $this;
    }

    /**
     * @return MediaObject|null
     */
    public function getPhotoPermisVerso(): ?MediaObject
    {
        return $this->photoPermisVerso;
    }

    /**
     * @param MediaObject|null $photoPermisVerso
     * @return Artisan
     */
    public function setPhotoPermisVerso(?MediaObject $photoPermisVerso): Artisan
    {
        $this->photoPermisVerso = $photoPermisVerso;
        return $this;
    }

    /**
     * @return MediaObject|null
     */
    public function getPhotoPermisRecto(): ?MediaObject
    {
        return $this->photoPermisRecto;
    }

    /**
     * @param MediaObject|null $photoPermisRecto
     * @return Artisan
     */
    public function setPhotoPermisRecto(?MediaObject $photoPermisRecto): Artisan
    {
        $this->photoPermisRecto = $photoPermisRecto;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTelephoneUrgence(): ?string
    {
        return $this->telephoneUrgence;
    }

    /**
     * @param string|null $telephoneUrgence
     * @return Artisan
     */
    public function setTelephoneUrgence(?string $telephoneUrgence): Artisan
    {
        $this->telephoneUrgence = $telephoneUrgence;
        return $this;
    }


}
