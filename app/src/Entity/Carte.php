<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CarteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarteRepository::class)]
#[ORM\Table(name: '`cartes`')]
#[ORM\HasLifecycleCallbacks()]
#[ApiResource]
class Carte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?string $date_expiration = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?string $date_edition = null;

    #[ORM\ManyToOne(targetEntity: MediaObject::class)]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['media_object:read', 'media_object:write'])]
    #[ApiProperty(types: ['https://schema.org/image'])]
    public ?MediaObject $image_recto = null;

    #[ORM\ManyToOne(targetEntity: MediaObject::class)]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['media_object:read', 'media_object:write'])]
    #[ApiProperty(types: ['https://schema.org/image'])]
    public ?MediaObject $image_verso = null;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $statut = false;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $is_expired = false;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $numero_rm = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $numero_carte_professionnelle = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $created_at;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $modified_at;

    #[ORM\ManyToOne(inversedBy: 'carte')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Artisan $artisan = null;

    #[ORM\OneToOne(mappedBy: 'carte', cascade: ['persist', 'remove'])]
    private ?Impression $impression = null;

    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->modified_at = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }


    public function getArtisan(): ?Artisan
    {
        return $this->artisan;
    }

    public function setArtisan(?Artisan $artisan): self
    {
        $this->artisan = $artisan;

        return $this;
    }

    public function getDateExpiration(): ?string
    {
        return $this->date_expiration;
    }

    public function setDateExpiration(?string $date_expiration): void
    {
        $this->date_expiration = $date_expiration;
    }

    public function getDateEdition(): ?string
    {
        return $this->date_edition;
    }

    public function setDateEdition(?string $date_edition): void
    {
        $this->date_edition = $date_edition;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getModifiedAt(): ?\DateTimeInterface
    {
        return $this->modified_at;
    }

    public function setModifiedAt(?\DateTimeInterface $modified_at): void
    {
        $this->modified_at = $modified_at;
    }

    public function getNumeroRm(): ?string
    {
        return $this->numero_rm;
    }

    public function setNumeroRm(?string $numero_rm): void
    {
        $this->numero_rm = $numero_rm;
    }

    public function getNumeroCarteProfessionelle(): ?string
    {
        return $this->numero_carte_professionelle;
    }

    public function setNumeroCarteProfessionelle(?string $numero_carte_professionelle): void
    {
        $this->numero_carte_professionelle = $numero_carte_professionelle;
    }

    /**
     * @return bool|null
     */
    public function getStatut(): ?bool
    {
        return $this->statut;
    }

    /**
     * @param bool|null $statut
     * @return Carte
     */
    public function setStatut(?bool $statut): Carte
    {
        $this->statut = $statut;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsExpired(): ?bool
    {
        return $this->is_expired;
    }

    /**
     * @param bool|null $is_expired
     * @return Carte
     */
    public function setIsExpired(?bool $is_expired): Carte
    {
        $this->is_expired = $is_expired;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumeroCarteProfessionnelle(): ?string
    {
        return $this->numero_carte_professionnelle;
    }

    /**
     * @param string|null $numero_carte_professionnelle
     * @return Carte
     */
    public function setNumeroCarteProfessionnelle(?string $numero_carte_professionnelle): Carte
    {
        $this->numero_carte_professionnelle = $numero_carte_professionnelle;
        return $this;
    }

    /**
     * @return MediaObject|null
     */
    public function getImageRecto(): ?MediaObject
    {
        return $this->image_recto;
    }

    /**
     * @param MediaObject|null $image_recto
     * @return Carte
     */
    public function setImageRecto(?MediaObject $image_recto): Carte
    {
        $this->image_recto = $image_recto;
        return $this;
    }

    /**
     * @return MediaObject|null
     */
    public function getImageVerso(): ?MediaObject
    {
        return $this->image_verso;
    }

    /**
     * @param MediaObject|null $image_verso
     * @return Carte
     */
    public function setImageVerso(?MediaObject $image_verso): Carte
    {
        $this->image_verso = $image_verso;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * @return Carte
     */
    public function setType(?string $type): Carte
    {
        $this->type = $type;
        return $this;
    }

    public function getImpression(): ?Impression
    {
        return $this->impression;
    }

    public function setImpression(?Impression $impression): static
    {
        // unset the owning side of the relation if necessary
        if ($impression === null && $this->impression !== null) {
            $this->impression->setCarte(null);
        }

        // set the owning side of the relation if necessary
        if ($impression !== null && $impression->getCarte() !== $this) {
            $impression->setCarte($this);
        }

        $this->impression = $impression;

        return $this;
    }


}
