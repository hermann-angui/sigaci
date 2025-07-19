<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ImpressionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImpressionRepository::class)]
#[ApiResource]
class Impression
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\OneToOne(inversedBy: 'impression', cascade: ['persist', 'remove'])]
    private ?Carte $carte = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Registre $registre = null;

    #[ORM\ManyToOne(inversedBy: 'impressions')]
    private ?ImpressionGroup $impressionGroup = null;

    #[ORM\ManyToOne(inversedBy: 'impressions')]
    private ?User $madeBy = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarte(): ?Carte
    {
        return $this->carte;
    }

    public function setCarte(?Carte $carte): static
    {
        $this->carte = $carte;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getRegistre(): ?Registre
    {
        return $this->registre;
    }

    public function setRegistre(?Registre $registre): static
    {
        $this->registre = $registre;

        return $this;
    }

    public function getImpressionGroup(): ?ImpressionGroup
    {
        return $this->impressionGroup;
    }

    public function setImpressionGroup(?ImpressionGroup $impressionGroup): static
    {
        $this->impressionGroup = $impressionGroup;

        return $this;
    }

    public function getMadeBy(): ?User
    {
        return $this->madeBy;
    }

    public function setMadeBy(?User $madeBy): static
    {
        $this->madeBy = $madeBy;

        return $this;
    }
}
