<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ImpressionGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImpressionGroupRepository::class)]
#[ApiResource()]
class ImpressionGroup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Impression>
     */
    #[ORM\OneToMany(targetEntity: Impression::class, mappedBy: 'impressionGroup')]
    private Collection $impressions;

    public function __construct()
    {
        $this->impressions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Impression>
     */
    public function getImpressions(): Collection
    {
        return $this->impressions;
    }

    public function addImpression(Impression $impression): static
    {
        if (!$this->impressions->contains($impression)) {
            $this->impressions->add($impression);
            $impression->setImpressionGroup($this);
        }

        return $this;
    }

    public function removeImpression(Impression $impression): static
    {
        if ($this->impressions->removeElement($impression)) {
            // set the owning side to null (unless already changed)
            if ($impression->getImpressionGroup() === $this) {
                $impression->setImpressionGroup(null);
            }
        }

        return $this;
    }
}
