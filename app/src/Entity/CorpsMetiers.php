<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CorpsMetiersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: CorpsMetiersRepository::class)]
#[ORM\Table(name: '`corps_metiers`')]
#[UniqueEntity(fields: ['name'])]
#[ORM\HasLifecycleCallbacks()]
#[ApiResource]
class CorpsMetiers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: "string", length: 500, nullable: true)]
    private string $description;

    #[ORM\ManyToOne(targetEntity: BrancheMetier::class, inversedBy: 'corps_metiers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?BrancheMetier $branche_metier = null;

    #[ORM\OneToMany(mappedBy: 'corpsMetiers', targetEntity: Metiers::class, cascade: ["persist"])]
    private Collection $metiers;

    public function __construct()
    {
        $this->metiers = new ArrayCollection();
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBrancheMetier(): ?BrancheMetier
    {
        return $this->branche_metier;
    }

    public function setBrancheMetier(?BrancheMetier $branche_metier): self
    {
        $this->branche_metier = $branche_metier;

        return $this;
    }

    /**
     * @return Collection<int, Metiers>
     */
    public function getMetiers(): Collection
    {
        return $this->metiers;
    }

    public function addMetier(Metiers $metier): self
    {
        if (!$this->metiers->contains($metier)) {
            $this->metiers[] = $metier;
            $metier->setCorpsMetiers($this);
        }

        return $this;
    }

    public function removeMetier(Metiers $metier): self
    {
        if ($this->metiers->removeElement($metier)) {
            // set the owning side to null (unless already changed)
            if ($metier->getCorpsMetiers() === $this) {
                $metier->setCorpsMetiers(null);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param ?string $description
     * @return CorpsMetiers
     */
    public function setDescription(?string $description): CorpsMetiers
    {
        $this->description = $description;
        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
