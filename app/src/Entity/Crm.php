<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CrmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: CrmRepository::class)]
#[ORM\Table(name: '`crms`')]
#[UniqueEntity(fields: ['name'])]
#[ORM\HasLifecycleCallbacks()]
#[ApiResource(
    normalizationContext: ['groups' => ['artisan:read', 'crm:read']],
    denormalizationContext: ['groups' => ['artisan:create', 'crm:create', 'crm:delete', 'crm:update']]
)]
class Crm
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    #[Groups(['artisan:read', 'crm:read', 'crm:update', 'crm:delete'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true, nullable: true)]
    #[Groups(['artisan:read', 'crm:read', 'crm:update', 'crm:update'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['artisan:read', 'crm:read', 'crm:update'])]
    private ?string $code = null;

    #[ORM\Column(length: 255)]
    #[Groups(['artisan:read', 'crm:read', 'crm:update', 'crm:update'])]
    private ?string $abbr = null;

    /**
     * @var Collection<int, Entreprise>
     */
    #[ORM\OneToMany(targetEntity: Entreprise::class, mappedBy: 'crm')]
    private Collection $entreprises;

    public function __construct()
    {
        $this->entreprises = new ArrayCollection();
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

    public function __toString(): string
    {
        return $this->getName();
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
     * @return Crm
     */
    public function setCode(?string $code): Crm
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAbbr(): ?string
    {
        return $this->abbr;
    }

    /**
     * @param string|null $abbr
     * @return Crm
     */
    public function setAbbr(?string $abbr): Crm
    {
        $this->abbr = $abbr;
        return $this;
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
            $entreprise->setCrm($this);
        }

        return $this;
    }

    public function removeEntreprise(Entreprise $entreprise): static
    {
        if ($this->entreprises->removeElement($entreprise)) {
            // set the owning side to null (unless already changed)
            if ($entreprise->getCrm() === $this) {
                $entreprise->setCrm(null);
            }
        }

        return $this;
    }


}
