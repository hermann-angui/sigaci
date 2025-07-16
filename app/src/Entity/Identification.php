<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\IdentificationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: IdentificationRepository::class)]
#[ORM\Table(name: '`identifications`')]
#[ORM\HasLifecycleCallbacks()]
#[ApiResource]
class Identification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $status;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $created_at;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $updated_at;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $type;


    #[ORM\Column(length: 150, nullable: true)]
    private ?string $latitude;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $longitude;

    #[ORM\ManyToOne(inversedBy: 'identifications')]
    private ?User $agent = null;

    #[ORM\OneToOne(targetEntity: self::class)]
    private ?Artisan $artisan = null;

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

    public function getArtisan(): ?Artisan
    {
        return $this->artisan;
    }

    public function setArtisan(?Artisan $artisan): self
    {
        $this->artisan = $artisan;

        return $this;
    }

}
