<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ActivityLogsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use DateTime;


#[ORM\Entity(repositoryClass: ActivityLogsRepository::class)]
#[ORM\Table(name: '`equipe_agents`')]
#[ORM\HasLifecycleCallbacks()]
#[ApiResource]
class EquipeAgent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $created_at;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $modified_at;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'equipeAgent')]
    private Collection $membres;

    #[ORM\OneToOne(inversedBy: 'equipeAgent')]
    private ?User $superviseur = null;

    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->modified_at = new \DateTime();
        $this->membres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getMembres(): Collection
    {
        return $this->membres;
    }

    public function addMembre(User $membre): static
    {
        if (!$this->membres->contains($membre)) {
            $this->membres->add($membre);
            $membre->setEquipeAgent($this);
        }

        return $this;
    }

    public function removeMembre(User $membre): static
    {
        if ($this->membres->removeElement($membre)) {
            // set the owning side to null (unless already changed)
            if ($membre->getEquipeAgent() === $this) {
                $membre->setEquipeAgent(null);
            }
        }

        return $this;
    }

    public function getSuperviseur(): ?User
    {
        return $this->superviseur;
    }

    public function setSuperviseur(?User $superviseur): static
    {
        $this->superviseur = $superviseur;

        return $this;
    }

}
