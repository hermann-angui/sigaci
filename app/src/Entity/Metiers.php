<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MetiersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: MetiersRepository::class)]
#[ORM\Table(name: '`metiers`')]
#[UniqueEntity(fields: ['name'])]
#[ORM\HasLifecycleCallbacks()]
#[ApiResource]
class Metiers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    private string $name;

    #[ORM\Column(type: "string", length: 500, nullable: true)]
    private ?string $description;

    #[ORM\ManyToOne(targetEntity: CorpsMetiers::class, inversedBy: 'metiers')]
    private ?CorpsMetiers $corpsMetiers = null;

    /**
     * @var Collection<int, Artisan>
     */
    #[ORM\OneToMany(targetEntity: Artisan::class, mappedBy: 'activitePrincipale')]
    private Collection $artisanActvitePrincipales;

    /**
     * @var Collection<int, Etablissement>
     */
    #[ORM\OneToMany(targetEntity: Etablissement::class, mappedBy: 'activitePrincipale')]
    private Collection $etablissements;

    public function __construct()
    {
        $this->artisanActvitePrincipales = new ArrayCollection();
        $this->etablissements = new ArrayCollection();
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

    public function getCorpsMetiers(): ?CorpsMetiers
    {
        return $this->corpsMetiers;
    }

    public function setCorpsMetiers(?CorpsMetiers $corpsMetiers): self
    {
        $this->corpsMetiers = $corpsMetiers;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param ?string $name
     * @return Metiers
     */
    public function setName(?string $name): Metiers
    {
        $this->name = $name;
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
     * @param string $description
     * @return Metiers
     */
    public function setDescription(string $description): Metiers
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return Collection<int, Artisan>
     */
    public function getArtisanActvitePrincipales(): Collection
    {
        return $this->artisanActvitePrincipales;
    }

    public function addArtisanActvitePrincipale(Artisan $artisanActvitePrincipale): static
    {
        if (!$this->artisanActvitePrincipales->contains($artisanActvitePrincipale)) {
            $this->artisanActvitePrincipales->add($artisanActvitePrincipale);
            $artisanActvitePrincipale->setActivitePrincipale($this);
        }

        return $this;
    }

    public function removeArtisanActvitePrincipale(Artisan $artisanActvitePrincipale): static
    {
        if ($this->artisanActvitePrincipales->removeElement($artisanActvitePrincipale)) {
            // set the owning side to null (unless already changed)
            if ($artisanActvitePrincipale->getActivitePrincipale() === $this) {
                $artisanActvitePrincipale->setActivitePrincipale(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }

    /**
     * @return Collection<int, Etablissement>
     */
    public function getEtablissements(): Collection
    {
        return $this->etablissements;
    }

    public function addEtablissement(Etablissement $etablissement): static
    {
        if (!$this->etablissements->contains($etablissement)) {
            $this->etablissements->add($etablissement);
            $etablissement->setActivitePrincipale($this);
        }

        return $this;
    }

    public function removeEtablissement(Etablissement $etablissement): static
    {
        if ($this->etablissements->removeElement($etablissement)) {
            // set the owning side to null (unless already changed)
            if ($etablissement->getActivitePrincipale() === $this) {
                $etablissement->setActivitePrincipale(null);
            }
        }

        return $this;
    }


}
