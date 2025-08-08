<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EntrepriseActiviteRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseActiviteRepository::class)]
#[ORM\Table(name: '`entreprise_activites`')]
#[ORM\HasLifecycleCallbacks()]
#[ApiResource()]
class EntrepriseActivite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateDebutActivite;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adressPostale;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telephone;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fax;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $quartier;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $village;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lot;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ilot;

    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $effectifSalarieHomme;

    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $effectifSalarieFemme;

    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $effectifApprentiHomme;

    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $effectifApprentiFemme;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $latitude;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $longitude;

    #[ORM\Column(length: 255, nullable: true)]
    private ?bool $estPrincipale = false;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'entrepriseActivites')]
    private ?self $crm = null;

    /**
     * @var Collection<int, Artisan>
     */
    #[ORM\OneToMany(targetEntity: Artisan::class, mappedBy: 'entrepriseActivite')]
    private Collection $employees;

    #[ORM\ManyToOne(inversedBy: 'entrepriseActivites')]
    private ?Department $department = null;

    #[ORM\ManyToOne]
    private ?Communes $commune = null;

    #[ORM\ManyToOne]
    private ?SousPrefecture $sousPrefecture = null;

    #[ORM\ManyToOne]
    private ?Villes $ville = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Registre $registre = null;

    #[ORM\ManyToOne(inversedBy: 'entrepriseActivites')]
    private ?Metiers $activite = null;

    #[ORM\ManyToOne(inversedBy: 'activites')]
    private ?Entreprise $entreprise = null;

    public function __construct()
    {
        $this->employees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): void
    {
        $this->latitude = $latitude;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): void
    {
        $this->longitude = $longitude;
    }


    /**
     * @return \DateTimeInterface
     */
    public function getDateDebutActivite(): \DateTimeInterface
    {
        return $this->dateDebutActivite;
    }

    /**
     * @param DateTime|null $dateDebutActivite
     * @return Entreprise
     */
    public function setDateDebutActivite(?DateTime $dateDebutActivite): EntrepriseActivite
    {
        $this->dateDebutActivite = $dateDebutActivite;
        return $this;
    }


    /**
     * @return string|null
     */
    public function getAdressPostale(): ?string
    {
        return $this->adressPostale;
    }

    /**
     * @param string|null $adressPostale
     * @return Entreprise
     */
    public function setAdressPostale(?string $adressPostale): EntrepriseActivite
    {
        $this->adressPostale = $adressPostale;
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
     * @return Entreprise
     */
    public function setTelephone(?string $telephone): EntrepriseActivite
    {
        $this->telephone = $telephone;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFax(): ?string
    {
        return $this->fax;
    }

    /**
     * @param string|null $fax
     * @return Entreprise
     */
    public function setFax(?string $fax): EntrepriseActivite
    {
        $this->fax = $fax;
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
     * @return Entreprise
     */
    public function setQuartier(?string $quartier): EntrepriseActivite
    {
        $this->quartier = $quartier;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getVillage(): ?string
    {
        return $this->village;
    }

    /**
     * @param string|null $village
     * @return Entreprise
     */
    public function setVillage(?string $village): EntrepriseActivite
    {
        $this->village = $village;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLot(): ?string
    {
        return $this->lot;
    }

    /**
     * @param string|null $lot
     * @return Entreprise
     */
    public function setLot(?string $lot): EntrepriseActivite
    {
        $this->lot = $lot;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIlot(): ?string
    {
        return $this->ilot;
    }

    /**
     * @param string|null $ilot
     * @return Entreprise
     */
    public function setIlot(?string $ilot): EntrepriseActivite
    {
        $this->ilot = $ilot;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getEffectifSalarieHomme(): ?int
    {
        return $this->effectifSalarieHomme;
    }

    /**
     * @param int|null $effectifSalarieHomme
     * @return Entreprise
     */
    public function setEffectifSalarieHomme(?int $effectifSalarieHomme): EntrepriseActivite
    {
        $this->effectifSalarieHomme = $effectifSalarieHomme;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getEffectifSalarieFemme(): ?int
    {
        return $this->effectifSalarieFemme;
    }

    /**
     * @param int|null $effectifSalarieFemme
     * @return Entreprise
     */
    public function setEffectifSalarieFemme(?int $effectifSalarieFemme): EntrepriseActivite
    {
        $this->effectifSalarieFemme = $effectifSalarieFemme;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getEffectifApprentiHomme(): ?int
    {
        return $this->effectifApprentiHomme;
    }

    /**
     * @param int|null $effectifApprentiHomme
     * @return Entreprise
     */
    public function setEffectifApprentiHomme(?int $effectifApprentiHomme): EntrepriseActivite
    {
        $this->effectifApprentiHomme = $effectifApprentiHomme;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getEffectifApprentiFemme(): ?int
    {
        return $this->effectifApprentiFemme;
    }

    /**
     * @param int|null $effectifApprentiFemme
     * @return Entreprise
     */
    public function setEffectifApprentiFemme(?int $effectifApprentiFemme): EntrepriseActivite
    {
        $this->effectifApprentiFemme = $effectifApprentiFemme;
        return $this;
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(?Department $department): static
    {
        $this->department = $department;

        return $this;
    }

    public function getCommune(): ?Communes
    {
        return $this->commune;
    }

    public function setCommune(?Communes $commune): static
    {
        $this->commune = $commune;

        return $this;
    }

    public function getSousPrefecture(): ?SousPrefecture
    {
        return $this->sousPrefecture;
    }

    public function setSousPrefecture(?SousPrefecture $sousPrefecture): static
    {
        $this->sousPrefecture = $sousPrefecture;

        return $this;
    }

    public function getVille(): ?Villes
    {
        return $this->ville;
    }

    public function setVille(?Villes $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getSigle();
    }

    /**
     * @return bool|null
     */
    public function getEstPrincipale(): ?bool
    {
        return $this->estPrincipale;
    }

    /**
     * @param bool|null $estPrincipale
     * @return EntrepriseActivite
     */
    public function setEstPrincipale(?bool $estPrincipale): EntrepriseActivite
    {
        $this->estPrincipale = $estPrincipale;
        return $this;
    }

    public function getCrm(): ?self
    {
        return $this->crm;
    }

    public function setCrm(?self $crm): static
    {
        $this->crm = $crm;

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

    public function getActivite(): ?Metiers
    {
        return $this->activite;
    }

    public function setActivite(?Metiers $activite): static
    {
        $this->activite = $activite;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): static
    {
        $this->entreprise = $entreprise;

        return $this;
    }

}
