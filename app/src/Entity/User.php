<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use DateTime;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`users`')]
#[ORM\HasLifecycleCallbacks()]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_USER', fields: ['email', 'username'])]
#[ApiResource(
    operations: [
        new Get(),
        new Post(),
        new Put(),
        new GetCollection(
            normalizationContext: [
                'groups' => ['user:read']
            ],
        ),
    ],
    normalizationContext: [
        'groups' => ['user:read']
    ],
    denormalizationContext:  [
        'groups' => ['user:create', 'user:update']
    ]
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user:read', 'user:create', 'user:update'])]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, unique: true, nullable: true)]
    #[Groups(['user:read', 'user:create', 'user:update'])]
    private ?string $username = null;

    #[ORM\Column(length: 180)]
    #[Groups(['user:read', 'user:create', 'user:update'])]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    #[Groups(['user:read', 'user:create', 'user:update'])]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Groups(['user:create', 'user:update'])]
    private ?string $password = null;

    private ?string $plain_password;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['user:read', 'user:create', 'user:update'])]
    private ?string $nom;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['user:read', 'user:create', 'user:update'])]
    private ?string $prenoms;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['user:read', 'user:create', 'user:update'])]
    private ?string $lieu_naissance;

    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Groups(['user:read', 'user:create', 'user:update'])]
    private ?string $date_de_naissance;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['user:read', 'user:create', 'user:update'])]
    private ?string $nationalite;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['user:read', 'user:create', 'user:update'])]
    private ?string $sexe;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['user:read', 'user:create', 'user:update'])]
    private ?string $cni;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['user:read', 'user:create', 'user:update'])]
    private ?string $telephone;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['user:read', 'user:create', 'user:update'])]
    private ?string $adresse;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['user:read', 'user:create', 'user:update'])]
    private ?string $ville;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['user:read', 'user:create', 'user:update'])]
    private ?string $commune;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['user:read', 'user:create', 'user:update'])]
    private ?string $quartier;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['user:read', 'user:create', 'user:update'])]
    private ?string $type;

    #[ORM\Column(type: 'boolean', nullable: true)]
    #[Groups(['user:read', 'user:create', 'user:update'])]
    private ?bool $is_active = false;

    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Groups(['user:read', 'user:create', 'user:update'])]
    private ?DateTime $created_at;

    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Groups(['user:read', 'user:create', 'user:update'])]
    private ?DateTime $modified_at;

    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Groups(['user:read', 'user:create', 'user:update'])]
    private ?DateTime $last_connection;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: ActivityLogs::class)]
    private Collection $activityLogs;

    #[ORM\ManyToOne(inversedBy: 'agents')]
    private ?Crm $crm = null;

    #[ORM\OneToMany(mappedBy: 'agent', targetEntity: Immatriculation::class)]
    private Collection $immatriculations;

    #[ORM\OneToMany(mappedBy: 'agent', targetEntity: Identification::class)]
    private Collection $identifications;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[Groups(['user:read'])]
    private ?MediaObject $photo = null;

    #[ORM\ManyToOne(inversedBy: 'membres')]
    private ?EquipeAgent $equipeAgent = null;

    /**
     * @var Collection<int, Impression>
     */
    #[ORM\OneToMany(targetEntity: Impression::class, mappedBy: 'madeBy')]
    private Collection $impressions;             // Recupère l'equipe dont fait partie l'agent

    public function __construct()
    {
        $this->created_at = new DateTime();
        $this->modified_at = new DateTime();
        $this->activityLogs = new ArrayCollection();
        $this->immatriculations = new ArrayCollection();
        $this->identifications = new ArrayCollection();
        $this->impressions = new ArrayCollection();
    }

    /**
     * Prepersist gets triggered on Insert
     * @ORM\PrePersist
     */
    public function updatedTimestamps()
    {
        if ($this->created_at == null) {
            $this->created_at = new DateTime('now');
        }
        $this->modified_at = new DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Ensure the session doesn't contain actual password hashes by CRC32C-hashing them, as supported since Symfony 7.3.
     */
    public function __serialize(): array
    {
        $data = (array) $this;
        $data["\0".self::class."\0password"] = hash('crc32c', $this->password);

        return $data;
    }

    #[\Deprecated]
    public function eraseCredentials(): void
    {
        // @deprecated, to be removed when upgrading to Symfony 8
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(?DateTime $createAt): self
    {
        $this->created_at = $createAt;

        return $this;
    }

    public function getModifiedAt(): ?DateTime
    {
        return $this->modified_at;
    }

    public function setModifiedAt(?DateTime $modified_at): self
    {
        $this->modified_at = $modified_at;

        return $this;
    }


    /**
     * @return Collection<int, ActivityLogs>
     */
    public function getActivityLogs(): Collection
    {
        return $this->activityLogs;
    }

    public function addActivityLog(ActivityLogs $activityLog): static
    {
        if (!$this->activityLogs->contains($activityLog)) {
            $this->activityLogs->add($activityLog);
            $activityLog->setUser($this);
        }

        return $this;
    }

    public function removeActivityLog(ActivityLogs $activityLog): static
    {
        if ($this->activityLogs->removeElement($activityLog)) {
            // set the owning side to null (unless already changed)
            if ($activityLog->getUser() === $this) {
                $activityLog->setUser(null);
            }
        }

        return $this;
    }

    public function getCrm(): ?Crm
    {
        return $this->crm;
    }

    public function setCrm(?Crm $crm): self
    {
        $this->crm = $crm;

        return $this;
    }

    /**
     * @return Collection<int, Immatriculation>
     */
    public function getImmatriculations(): Collection
    {
        return $this->immatriculations;
    }

    public function addImmatriculation(Immatriculation $immatriculation): self
    {
        if (!$this->immatriculations->contains($immatriculation)) {
            $this->immatriculations[] = $immatriculation;
            $immatriculation->setAgent($this);
        }

        return $this;
    }

    public function removeImmatriculation(Immatriculation $immatriculation): self
    {
        if ($this->immatriculations->removeElement($immatriculation)) {
            // set the owning side to null (unless already changed)
            if ($immatriculation->getAgent() === $this) {
                $immatriculation->setAgent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Identification>
     */
    public function getIdentifications(): Collection
    {
        return $this->identifications;
    }

    public function addIdentification(Identification $identification): self
    {
        if (!$this->identifications->contains($identification)) {
            $this->identifications[] = $identification;
            $identification->setAgent($this);
        }

        return $this;
    }

    public function removeIdentification(Identification $identification): self
    {
        if ($this->identifications->removeElement($identification)) {
            // set the owning side to null (unless already changed)
            if ($identification->getAgent() === $this) {
                $identification->setAgent(null);
            }
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     * @return User
     */
    public function setUsername(?string $username): User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPlainPassword(): ?string
    {
        return $this->plain_password;
    }

    /**
     * @param string|null $plain_password
     * @return User
     */
    public function setPlainPassword(?string $plain_password): User
    {
        $this->plain_password = $plain_password;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string|null $nom
     * @return User
     */
    public function setNom(?string $nom): User
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrenoms(): ?string
    {
        return $this->prenoms;
    }

    /**
     * @param string|null $prenoms
     * @return User
     */
    public function setPrenoms(?string $prenoms): User
    {
        $this->prenoms = $prenoms;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLieuNaissance(): ?string
    {
        return $this->lieu_naissance;
    }

    /**
     * @param string|null $lieu_naissance
     * @return User
     */
    public function setLieuNaissance(?string $lieu_naissance): User
    {
        $this->lieu_naissance = $lieu_naissance;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateDeNaissance(): ?string
    {
        return $this->date_de_naissance;
    }

    /**
     * @param string|null $date_de_naissance
     * @return User
     */
    public function setDateDeNaissance(?string $date_de_naissance): User
    {
        $this->date_de_naissance = $date_de_naissance;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    /**
     * @param string|null $nationalite
     * @return User
     */
    public function setNationalite(?string $nationalite): User
    {
        $this->nationalite = $nationalite;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    /**
     * @param string|null $sexe
     * @return User
     */
    public function setSexe(?string $sexe): User
    {
        $this->sexe = $sexe;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCni(): ?string
    {
        return $this->cni;
    }

    /**
     * @param string|null $cni
     * @return User
     */
    public function setCni(?string $cni): User
    {
        $this->cni = $cni;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    /**
     * @param string|null $telephone
     * @return User
     */
    public function setTelephone(?string $telephone): User
    {
        $this->telephone = $telephone;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    /**
     * @param string|null $adresse
     * @return User
     */
    public function setAdresse(?string $adresse): User
    {
        $this->adresse = $adresse;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getVille(): ?string
    {
        return $this->ville;
    }

    /**
     * @param string|null $ville
     * @return User
     */
    public function setVille(?string $ville): User
    {
        $this->ville = $ville;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCommune(): ?string
    {
        return $this->commune;
    }

    /**
     * @param string|null $commune
     * @return User
     */
    public function setCommune(?string $commune): User
    {
        $this->commune = $commune;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getQuartier(): ?string
    {
        return $this->quartier;
    }

    /**
     * @param string|null $quartier
     * @return User
     */
    public function setQuartier(?string $quartier): User
    {
        $this->quartier = $quartier;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * @return User
     */
    public function setType(?string $type): User
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    /**
     * @param bool|null $is_active
     * @return User
     */
    public function setIsActive(?bool $is_active): User
    {
        $this->is_active = $is_active;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getLastConnection(): ?DateTime
    {
        return $this->last_connection;
    }

    /**
     * @param DateTime|null $last_connection
     * @return User
     */
    public function setLastConnection(?DateTime $last_connection): User
    {
        $this->last_connection = $last_connection;
        return $this;
    }

    /**
     * @return MediaObject|null
     */
    public function getPhoto(): ?MediaObject
    {
        return $this->photo;
    }

    /**
     * @param MediaObject|null $photo
     * @return User
     */
    public function setPhoto(?MediaObject $photo): User
    {
        $this->photo = $photo;
        return $this;
    }

    public function getEquipeAgent(): ?EquipeAgent
    {
        return $this->equipeAgent;
    }

    public function setEquipeAgent(?EquipeAgent $equipeAgent): static
    {
        $this->equipeAgent = $equipeAgent;

        return $this;
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
            $impression->setMadeBy($this);
        }

        return $this;
    }

    public function removeImpression(Impression $impression): static
    {
        if ($this->impressions->removeElement($impression)) {
            // set the owning side to null (unless already changed)
            if ($impression->getMadeBy() === $this) {
                $impression->setMadeBy(null);
            }
        }

        return $this;
    }


}
