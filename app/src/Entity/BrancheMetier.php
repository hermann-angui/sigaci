<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\BranchMetierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BranchMetierRepository::class)]
#[ORM\Table(name: '`branche_metiers`')]
#[ORM\HasLifecycleCallbacks()]
#[ApiResource()]
class BrancheMetier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    private string $name;

    #[ORM\Column(length: 255)]
    private string $code;

    #[ORM\Column(type: "string", length: 500, nullable: true)]
    private ?string $description;

    #[ORM\OneToMany(mappedBy: 'branche_metier', targetEntity: CorpsMetiers::class, cascade: ["persist"])]
    private Collection $corps_metiers;

    public function __construct()
    {
        $this->corps_metiers = new ArrayCollection();
        $this->code = substr(bin2hex(random_bytes(10)), 0, 10);
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

    /**
     * @return Collection<int, CorpsMetiers>
     */
    public function getCorpsMetiers(): Collection
    {
        return $this->corps_metiers;
    }

    public function addCorpsMetiers(CorpsMetiers $corpsMetiers): self
    {
        if (!$this->corps_metiers->contains($corpsMetiers)) {
            $this->corps_metiers[] = $corpsMetiers;
            $corpsMetiers->setBrancheMetier($this);
        }

        return $this;
    }

    public function removeCorpsMetiers(CorpsMetiers $corps_metiers): self
    {
        if ($this->corps_metiers->removeElement($corps_metiers)) {
            // set the owning side to null (unless already changed)
            if ($corps_metiers->getBrancheMetier() === $this) {
                $corps_metiers->setBrancheMetier(null);
            }
        }

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
     * @param string $name
     * @return BrancheMetier
     */
    public function setName(string $name): BrancheMetier
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
     * @param ?string $description
     * @return BrancheMetier
     */
    public function setDescription(?string $description): BrancheMetier
    {
        $this->description = $description;
        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return BrancheMetier
     */
    public function setCode(string $code): BrancheMetier
    {
        $this->code = $code;
        return $this;
    }

}
