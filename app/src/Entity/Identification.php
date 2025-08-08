<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\IdentificationRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;


#[ORM\Entity(repositoryClass: IdentificationRepository::class)]
#[ORM\Table(name: '`identifications`')]
#[ORM\HasLifecycleCallbacks()]
#[ApiResource()]
class Identification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $status;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $created_at;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $modified_at;

    #[ORM\Column(length: 150, nullable: true, unique: true)]
    private ?string $reference;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $code;

    #[ORM\Column(type:"string", unique:true)]
    private ?string $numeroReferenceExterne;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $source;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $type;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $latitude;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $longitude;

    #[ORM\ManyToOne(inversedBy: 'identifications')]
    private ?User $agent = null;

    public function __construct()
    {
        $this->reference = Uuid::v4()->toRfc4122();
        $this->created_at = new DateTime();
        $this->modified_at = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
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
     * @return Identification
     */
    public function setCreatedAt(?DateTimeInterface $created_at): void
    {
        $this->created_at = $created_at;
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
     * @return Identification
     */
    public function setModifiedAt(?DateTimeInterface $modified_at): void
    {
        $this->modified_at = $modified_at;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): void
    {
        $this->latitude = $latitude;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): void
    {
        $this->longitude = $longitude;
    }

    public function getAgent(): ?User
    {
        return $this->agent;
    }

    public function setAgent(?User $agent): self
    {
        $this->agent = $agent;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSource(): ?string
    {
        return $this->source;
    }

    /**
     * @param string|null $source
     * @return Identification
     */
    public function setSource(?string $source): Identification
    {
        $this->source = $source;
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
     * @return Identification
     */
    public function setReference(?string $reference): Identification
    {
        $this->reference = $reference;
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
     * @return Identification
     */
    public function setNumeroReferenceExterne(?string $numeroReferenceExterne): Identification
    {
        $this->numeroReferenceExterne = $numeroReferenceExterne;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string|null $code
     * @return Identification
     */
    public function setCode(?string $code): Identification
    {
        $this->code = $code;
        return $this;
    }

}
