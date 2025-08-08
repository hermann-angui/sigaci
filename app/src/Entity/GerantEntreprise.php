<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\GerantEntrepriseRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: GerantEntrepriseRepository::class)]
#[ORM\Table(name: '`gerant_entreprise`')]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
        new Put()
    ],
    normalizationContext: ['groups' => ['gerant:read', 'entreprise:read']],
    denormalizationContext: ['groups' => ['gerant:create','entreprise:read', 'gerant:delete', 'gerant:update']],
)]
class GerantEntreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    #[Groups(['gerant:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true, nullable: true)]
    #[Groups(['gerant:read', 'gerant:create', 'gerant:update'])]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['gerant:read', 'gerant:create', 'gerant:update'])]
    private ?string $nom;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['gerant:read', 'gerant:create', 'gerant:update'])]
    private ?string $prenoms;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['gerant:read', 'gerant:create', 'gerant:update'])]
    private ?DateTimeInterface $dateNaissance;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['gerant:read', 'gerant:create', 'gerant:update'])]
    private ?string $lieuNaissance;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['gerant:read', 'gerant:create', 'gerant:update'])]
    private ?string $sexe;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['gerant:read', 'gerant:create', 'gerant:update'])]
    private ?string $domicile;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['gerant:read', 'gerant:create', 'gerant:update'])]
    private ?string $quartier;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['gerant:read', 'gerant:create', 'gerant:update'])]
    private ?string $typePieceIdentite;

    #[ORM\Column(length: 255,unique: true, nullable: true)]
    #[Groups(['gerant:read', 'gerant:create', 'gerant:update'])]
    private ?string $numeroPieceIdentite;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['gerant:read', 'gerant:create', 'gerant:update'])]
    private ?string $lieuDelivrancePieceIdentite;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['gerant:read', 'gerant:create', 'gerant:update'])]
    private ?DateTimeInterface $dateDelivrancePieceIdentite;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['gerant:read', 'gerant:create', 'gerant:update'])]
    private ?string $autoriteDelivrancePieceIdentite;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['gerant:read', 'gerant:create', 'gerant:update'])]
    private ?string $etatCivil;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['gerant:read'])]
    private ?string $reference;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['gerant:read', 'gerant:create', 'gerant:update'])]
    private ?string $activiteExerceeLieu;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['gerant:read', 'gerant:create', 'gerant:update'])]
    private ?DateTimeInterface $dateDebutActivite;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['gerant:read', 'gerant:create', 'gerant:update'])]
    private ?DateTimeInterface $dateDebutActivitePro;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['gerant:read', 'gerant:create', 'gerant:update'])]
    private ?string $telephone;

    #[ORM\Column(length: 255, unique: true, nullable: true)]
    #[Groups(['gerant:read', 'gerant:create', 'gerant:update'])]
    private ?string $whatsapp;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['gerant:read', 'gerant:create', 'gerant:update'])]
    private ?string $codePostal;


    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['gerant:read', 'gerant:create', 'gerant:update'])]
    private ?DateTimeInterface $created_at;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['gerant:read', 'gerant:create', 'gerant:update'])]
    private ?DateTimeInterface $modified_at;

    #[ORM\ManyToOne]
    #[Groups(['gerant:read', 'gerant:create', 'gerant:update'])]
    private ?Villes $villeNaissance = null;

    #[ORM\ManyToOne]
    #[Groups(['gerant:read', 'gerant:create', 'gerant:update'])]
    private ?Pays $paysNaissance = null;

    #[ORM\ManyToOne]
    #[Groups(['gerant:read', 'gerant:create', 'gerant:update'])]
    private ?Pays $nationalite = null;

    #[ORM\OneToOne]
    private ?EntrepriseActivite $entrepriseActivite = null;

    public function __construct()
    {
        $this->created_at = new DateTime();
        $this->modified_at = new DateTime();
        $this->reference = Uuid::v4()->toString();
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


    /**
     * @return string|null
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string|null $nom
     * @return GerantEntreprise
     */
    public function setNom(?string $nom): GerantEntreprise
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
     * @return GerantEntreprise
     */
    public function setSexe(?string $sexe): GerantEntreprise
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
     * @return GerantEntreprise
     */
    public function setPrenoms(?string $prenoms): GerantEntreprise
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
     * @return GerantEntreprise
     */
    public function setDateNaissance(?DateTimeInterface $dateNaissance): GerantEntreprise
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
     * @return GerantEntreprise
     */
    public function setLieuNaissance(?string $lieuNaissance): GerantEntreprise
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
     * @return GerantEntreprise
     */
    public function setDomicile(?string $domicile): GerantEntreprise
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
     * @return GerantEntreprise
     */
    public function setQuartier(?string $quartier): GerantEntreprise
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
     * @return GerantEntreprise
     */
    public function setTypePieceIdentite(?string $typePieceIdentite): GerantEntreprise
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
     * @return GerantEntreprise
     */
    public function setNumeroPieceIdentite(?string $numeroPieceIdentite): GerantEntreprise
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
     * @return GerantEntreprise
     */
    public function setLieuDelivrancePieceIdentite(?string $lieuDelivrancePieceIdentite): GerantEntreprise
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
     * @return GerantEntreprise
     */
    public function setDateDelivrancePieceIdentite(?DateTimeInterface $dateDelivrancePieceIdentite): GerantEntreprise
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
     * @return GerantEntreprise
     */
    public function setAutoriteDelivrancePieceIdentite(?string $autoriteDelivrancePieceIdentite): GerantEntreprise
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
     * @return GerantEntreprise
     */
    public function setEtatCivil(?string $etatCivil): GerantEntreprise
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
     * @return GerantEntreprise
     */
    public function setActiviteExerceeLieu(?string $activiteExerceeLieu): GerantEntreprise
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
     * @return GerantEntreprise
     */
    public function setDateDebutActivite(?DateTimeInterface $dateDebutActivite): GerantEntreprise
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
     * @return GerantEntreprise
     */
    public function setDateDebutActivitePro(?DateTimeInterface $dateDebutActivitePro): GerantEntreprise
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
     * @return GerantEntreprise
     */
    public function setTelephone(?string $telephone): GerantEntreprise
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
     * @return GerantEntreprise
     */
    public function setWhatsapp(?string $whatsapp): GerantEntreprise
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
     * @return GerantEntreprise
     */
    public function setCodePostal(?string $codePostal): GerantEntreprise
    {
        $this->codePostal = $codePostal;
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
     * @return GerantEntreprise
     */
    public function setCreatedAt(?DateTimeInterface $created_at): GerantEntreprise
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
     * @return GerantEntreprise
     */
    public function setModifiedAt(?DateTimeInterface $modified_at): GerantEntreprise
    {
        $this->modified_at = $modified_at;
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


    public function getEntrepriseActivite(): ?EntrepriseActivite
    {
        return $this->entrepriseActivite;
    }

    public function setEntrepriseActivite(?EntrepriseActivite $entrepriseActivite): static
    {
        $this->entrepriseActivite = $entrepriseActivite;

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
     * @return GerantEntreprise
     */
    public function setReference(?string $reference): GerantEntreprise
    {
        $this->reference = $reference;
        return $this;
    }

}
