<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CrmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: CrmRepository::class)]
#[ORM\Table(name: '`crms`')]
#[UniqueEntity(fields: ['name'])]
#[ORM\HasLifecycleCallbacks()]
#[ApiResource]
class Crm
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true, nullable: true)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'crm', targetEntity: Artisan::class)]
    private Collection $artisans;

    #[ORM\OneToMany(mappedBy: 'crm', targetEntity: User::class)]
    private Collection $agents;

    #[ORM\OneToMany(mappedBy: 'crm', targetEntity: Etablissement::class)]
    private Collection $etablissements;

    public function __construct()
    {
        $this->artisans = new ArrayCollection();
        $this->agents = new ArrayCollection();
        $this->etablissements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Crm
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Crm
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Collection<int, Artisan>
     */
    public function getArtisans(): Collection
    {
        return $this->artisans;
    }

    public function addArtisan(Artisan $artisan): self
    {
        if (!$this->artisans->contains($artisan)) {
            $this->artisans[] = $artisan;
            $artisan->setCrm($this);
        }

        return $this;
    }

    public function removeArtisan(Artisan $artisan): self
    {
        if ($this->artisans->removeElement($artisan)) {
            // set the owning side to null (unless already changed)
            if ($artisan->getCrm() === $this) {
                $artisan->setCrm(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getAgents(): Collection
    {
        return $this->agents;
    }

    public function addAgent(User $agent): self
    {
        if (!$this->agents->contains($agent)) {
            $this->agents[] = $agent;
            $agent->setCrm($this);
        }

        return $this;
    }

    public function removeAgent(User $agent): self
    {
        if ($this->agents->removeElement($agent)) {
            // set the owning side to null (unless already changed)
            if ($agent->getCrm() === $this) {
                $agent->setCrm(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Etablissement>
     */
    public function getEtablissements(): Collection
    {
        return $this->etablissements;
    }

    public function addEtablissement(Etablissement $etablissement): self
    {
        if (!$this->etablissements->contains($etablissement)) {
            $this->etablissements[] = $etablissement;
            $etablissement->setCrm($this);
        }

        return $this;
    }

    public function removeEtablissement(Etablissement $etablissement): self
    {
        if ($this->etablissements->removeElement($etablissement)) {
            // set the owning side to null (unless already changed)
            if ($etablissement->getCrm() === $this) {
                $etablissement->setCrm(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->getName();
    }
}
