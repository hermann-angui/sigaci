<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\DepartmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: DepartmentRepository::class)]
#[ORM\Table(name: '`departments`')]
#[UniqueEntity(fields: ['name'])]
#[ORM\HasLifecycleCallbacks()]
#[ApiResource()]
class Department
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Entreprise>
     */
    #[ORM\OneToMany(targetEntity: Entreprise::class, mappedBy: 'department')]
    private Collection $entreprises;

    /**
     * @var Collection<int, EntrepriseActivite>
     */
    #[ORM\OneToMany(targetEntity: EntrepriseActivite::class, mappedBy: 'department')]
    private Collection $entrepriseActivites;


    public function __construct()
    {
        $this->entreprises = new ArrayCollection();
        $this->entrepriseActivites = new ArrayCollection();
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

    public function __toString(): string
    {
        return $this->getName();
    }

    /**
     * @return Collection<int, Entreprise>
     */
    public function getEntreprises(): Collection
    {
        return $this->entreprises;
    }

    public function addEntreprise(Entreprise $entreprise): static
    {
        if (!$this->entreprises->contains($entreprise)) {
            $this->entreprises->add($entreprise);
            $entreprise->setDepartment($this);
        }

        return $this;
    }

    public function removeEntreprise(Entreprise $entreprise): static
    {
        if ($this->entreprises->removeElement($entreprise)) {
            // set the owning side to null (unless already changed)
            if ($entreprise->getDepartment() === $this) {
                $entreprise->setDepartment(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EntrepriseActivite>
     */
    public function getEntrepriseActivites(): Collection
    {
        return $this->entrepriseActivites;
    }

    public function addEntrepriseActivite(EntrepriseActivite $entrepriseActivite): static
    {
        if (!$this->entrepriseActivites->contains($entrepriseActivite)) {
            $this->entrepriseActivites->add($entrepriseActivite);
            $entrepriseActivite->setDepartment($this);
        }

        return $this;
    }

    public function removeEntrepriseActivite(EntrepriseActivite $entrepriseActivite): static
    {
        if ($this->entrepriseActivites->removeElement($entrepriseActivite)) {
            // set the owning side to null (unless already changed)
            if ($entrepriseActivite->getDepartment() === $this) {
                $entrepriseActivite->setDepartment(null);
            }
        }

        return $this;
    }
}
