<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ImmatriculationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImmatriculationRepository::class)]
#[ORM\Table(name: '`immatriculations`')]
#[ORM\HasLifecycleCallbacks()]
#[ApiResource(
    normalizationContext: ['groups' => ['immatriculation:read']]
)]
class Immatriculation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    #[Groups(['immatriculation:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 150, nullable: true)]
    #[Groups(['immatriculation:read'])]
    private ?string $status;

    #[Groups(['immatriculation:read'])]
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $created_at;

    #[Groups(['immatriculation:read'])]
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $updated_at;

    #[Groups(['immatriculation:read'])]
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $type;

    #[Groups(['immatriculation:read'])]
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $code;

    #[Groups(['immatriculation:read'])]
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $payment_type;

    #[Groups(['immatriculation:read'])]
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $latitude;

    #[Groups(['immatriculation:read'])]
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $longitude;

    #[Groups(['immatriculation:read'])]
    #[ORM\ManyToOne(inversedBy: 'immatriculations')]
    private ?User $agent = null;


    #[ORM\OneToOne(targetEntity: self::class)]
    private ?Identification $identification = null;

    #[ORM\OneToOne(targetEntity: self::class)]
    private ?Artisan $artisan = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function setCreatedAt(?string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public function getPaymentType(): ?string
    {
        return $this->payment_type;
    }

    public function setPaymentType(?string $payment_type): void
    {
        $this->payment_type = $payment_type;
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
     * @return Artisan|null
     */
    public function getArtisan(): ?Artisan
    {
        return $this->artisan;
    }

    /**
     * @param Artisan|null $artisan
     * @return Immatriculation
     */
    public function setArtisan(?Artisan $artisan): Immatriculation
    {
        $this->artisan = $artisan;
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
     * @return Immatriculation
     */
    public function setCode(?string $code): Immatriculation
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return Identification|null
     */
    public function getIdentification(): ?Identification
    {
        return $this->identification;
    }

    /**
     * @param Identification|null $identification
     * @return Immatriculation
     */
    public function setIdentification(?Identification $identification): Immatriculation
    {
        $this->identification = $identification;
        return $this;
    }

}
