<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RegistreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegistreRepository::class)]
#[ORM\Table(name: '`registres`')]
#[ORM\HasLifecycleCallbacks()]
#[ApiResource()]
class Registre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: MediaObject::class)]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['media_object:read', 'media_object:write'])]
    #[ApiProperty(types: ['https://schema.org/image'])]
    public ?MediaObject $image = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?string $date_expiration = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?string $date_edition = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $image_recto = null;


    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $statut = null;             // PENDING, P

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $type = null;    // "REA" ou "RM"

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $is_expired = false;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $image_verso = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $numero_rm = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $numero_carte_professionnelle = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $created_at;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $modified_at;

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

    public function getImageRecto(): ?string
    {
        return $this->image_recto;
    }

    public function setImageRecto(?string $image_recto): void
    {
        $this->image_recto = $image_recto;
    }

    public function getImageVerso(): ?string
    {
        return $this->image_verso;
    }

    public function setImageVerso(?string $image_verso): void
    {
        $this->image_verso = $image_verso;
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
     * @return string|null
     */
    public function getStatut(): ?string
    {
        return $this->statut;
    }

    /**
     * @param string|null $statut
     * @return Registre
     */
    public function setStatut(?string $statut): Registre
    {
        $this->statut = $statut;
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
     * @return Registre
     */
    public function setType(?string $type): Registre
    {
        $this->type = $type;
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
     * @return Registre
     */
    public function setIsExpired(?bool $is_expired): Registre
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
     * @return Registre
     */
    public function setNumeroCarteProfessionnelle(?string $numero_carte_professionnelle): Registre
    {
        $this->numero_carte_professionnelle = $numero_carte_professionnelle;
        return $this;
    }


    /**
     * @return MediaObject|null
     */
    public function getImage(): ?MediaObject
    {
        return $this->image;
    }

    /**
     * @param MediaObject|null $image
     * @return Carte
     */
    public function setImage(?MediaObject $image): Registre
    {
        $this->image = $image;
        return $this;
    }


}
