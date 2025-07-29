<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EntrepriseRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
#[ORM\Table(name: '`entreprises`')]
#[ORM\HasLifecycleCallbacks()]
#[ApiResource()]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $raisonSocial;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sigle;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $objetSocial;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $typeEntreprise;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numeroRCCM;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $capitalSocial;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $regimeFiscal;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nombreAssocie;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $dureePersonne;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $identifiantCnps;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numeroContribuable;

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

    #[ORM\Column(nullable: true)]
    private ?int $effectifSalarieHomme = null;

    #[ORM\Column(nullable: true)]
    private ?int $effectifSalarieFemme;

    #[ORM\Column(nullable: true)]
    private ?int $effectifApprentiHomme;

    #[ORM\Column(nullable: true)]
    private ?int $effectifApprentiFemme;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $latitude;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $longitude;

    /**
     * @var Collection<int, Artisan>
     */
    #[ORM\OneToMany(targetEntity: Artisan::class, mappedBy: 'entreprise')]
    private Collection $employees;

    #[ORM\ManyToOne(inversedBy: 'entreprises')]
    private ?Department $department = null;

    #[ORM\ManyToOne]
    private ?Communes $commune = null;

    #[ORM\ManyToOne(inversedBy: 'entreprises')]
    private ?Crm $crm = null;

    #[ORM\ManyToOne(inversedBy: 'entreprises')]
    private ?SousPrefecture $sousPrefecture = null;

    #[ORM\ManyToOne(inversedBy: 'entreprises')]
    private ?Villes $ville = null;

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
     * @return string|null
     */
    public function getRaisonSocial(): ?string
    {
        return $this->raisonSocial;
    }

    /**
     * @param string|null $raisonSocial
     * @return Entreprise
     */
    public function setRaisonSocial(?string $raisonSocial): Entreprise
    {
        $this->raisonSocial = $raisonSocial;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSigle(): ?string
    {
        return $this->sigle;
    }

    /**
     * @param string|null $sigle
     * @return Entreprise
     */
    public function setSigle(?string $sigle): Entreprise
    {
        $this->sigle = $sigle;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getObjetSocial(): ?string
    {
        return $this->objetSocial;
    }

    /**
     * @param string|null $objetSocial
     * @return Entreprise
     */
    public function setObjetSocial(?string $objetSocial): Entreprise
    {
        $this->objetSocial = $objetSocial;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDateDebutActivite(): ?DateTime
    {
        return $this->dateDebutActivite;
    }

    /**
     * @param DateTime|null $dateDebutActivite
     * @return Entreprise
     */
    public function setDateDebutActivite(?DateTime $dateDebutActivite): Entreprise
    {
        $this->dateDebutActivite = $dateDebutActivite;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTypeEntreprise(): ?string
    {
        return $this->typeEntreprise;
    }

    /**
     * @param string|null $typeEntreprise
     * @return Entreprise
     */
    public function setTypeEntreprise(?string $typeEntreprise): Entreprise
    {
        $this->typeEntreprise = $typeEntreprise;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumeroRCCM(): ?string
    {
        return $this->numeroRCCM;
    }

    /**
     * @param string|null $numeroRCCM
     * @return Entreprise
     */
    public function setNumeroRCCM(?string $numeroRCCM): Entreprise
    {
        $this->numeroRCCM = $numeroRCCM;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCapitalSocial(): ?string
    {
        return $this->capitalSocial;
    }

    /**
     * @param string|null $capitalSocial
     * @return Entreprise
     */
    public function setCapitalSocial(?string $capitalSocial): Entreprise
    {
        $this->capitalSocial = $capitalSocial;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRegimeFiscal(): ?string
    {
        return $this->regimeFiscal;
    }

    /**
     * @param string|null $regimeFiscal
     * @return Entreprise
     */
    public function setRegimeFiscal(?string $regimeFiscal): Entreprise
    {
        $this->regimeFiscal = $regimeFiscal;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNombreAssocie(): ?string
    {
        return $this->nombreAssocie;
    }

    /**
     * @param string|null $nombreAssocie
     * @return Entreprise
     */
    public function setNombreAssocie(?string $nombreAssocie): Entreprise
    {
        $this->nombreAssocie = $nombreAssocie;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDureePersonne(): ?string
    {
        return $this->dureePersonne;
    }

    /**
     * @param string|null $dureePersonne
     * @return Entreprise
     */
    public function setDureePersonne(?string $dureePersonne): Entreprise
    {
        $this->dureePersonne = $dureePersonne;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIdentifiantCnps(): ?string
    {
        return $this->identifiantCnps;
    }

    /**
     * @param string|null $identifiantCnps
     * @return Entreprise
     */
    public function setIdentifiantCnps(?string $identifiantCnps): Entreprise
    {
        $this->identifiantCnps = $identifiantCnps;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumeroContribuable(): ?string
    {
        return $this->numeroContribuable;
    }

    /**
     * @param string|null $numeroContribuable
     * @return Entreprise
     */
    public function setNumeroContribuable(?string $numeroContribuable): Entreprise
    {
        $this->numeroContribuable = $numeroContribuable;
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
    public function setAdressPostale(?string $adressPostale): Entreprise
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
    public function setTelephone(?string $telephone): Entreprise
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
    public function setFax(?string $fax): Entreprise
    {
        $this->fax = $fax;
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
    public function setLot(?string $lot): Entreprise
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
    public function setIlot(?string $ilot): Entreprise
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
    public function setEffectifSalarieHomme(?int $effectifSalarieHomme): Entreprise
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
    public function setEffectifSalarieFemme(?int $effectifSalarieFemme): Entreprise
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
    public function setEffectifApprentiHomme(?int $effectifApprentiHomme): Entreprise
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
    public function setEffectifApprentiFemme(?int $effectifApprentiFemme): Entreprise
    {
        $this->effectifApprentiFemme = $effectifApprentiFemme;
        return $this;
    }

    public function __toString(): string
    {
        return $this->getSigle();
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
    public function setQuartier(?string $quartier): Entreprise
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
    public function setVillage(?string $village): Entreprise
    {
        $this->village = $village;
        return $this;
    }

    /**
     * @return Collection<int, Artisan>
     */
    public function getEmployees(): Collection
    {
        return $this->employees;
    }

    public function addEmployee(Artisan $employee): static
    {
        if (!$this->employees->contains($employee)) {
            $this->employees->add($employee);
            $employee->setEntreprise($this);
        }

        return $this;
    }

    public function removeEmployee(Artisan $employee): static
    {
        if ($this->employees->removeElement($employee)) {
            // set the owning side to null (unless already changed)
            if ($employee->getEntreprise() === $this) {
                $employee->setEntreprise(null);
            }
        }

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

    public function getCrm(): ?Crm
    {
        return $this->crm;
    }

    public function setCrm(?Crm $crm): static
    {
        $this->crm = $crm;

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


}
