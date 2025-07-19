<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EtablissementRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtablissementRepository::class)]
#[ORM\Table(name: '`etablissements`')]
#[ORM\HasLifecycleCallbacks()]
#[ApiResource]
class Etablissement
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

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTime $dateDebutActivite;

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

    #[ORM\ManyToOne(inversedBy: 'etablissements')]
    private ?Crm $crm = null;

    #[ORM\OneToMany(mappedBy: 'etablissement', targetEntity: Artisan::class)]
    private Collection $artisans;

    #[ORM\ManyToOne(inversedBy: 'etablissements')]
    private ?Department $department = null;

    #[ORM\ManyToOne(inversedBy: 'etablissements')]
    private ?Communes $commune = null;

    #[ORM\ManyToOne(inversedBy: 'etablissements')]
    private ?SousPrefecture $sousPrefecture = null;

    #[ORM\ManyToOne(inversedBy: 'etablissements')]
    private ?Pays $pays = null;

    #[ORM\ManyToOne(inversedBy: 'etablissements')]
    private ?Villes $ville = null;

    public function __construct()
    {
        $this->artisans = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection<int, Artisan>
     */
    public function getArtisans(): Collection
    {
        return $this->artisans;
    }

    public function addArtisans(Artisan $artisan): self
    {
        if (!$this->artisans->contains($artisan)) {
            $this->artisans[] = $artisan;
            $artisan->setEtablissement($this);
        }

        return $this;
    }

    public function removeArtisans(Artisan $artisan): self
    {
        if ($this->artisans->removeElement($artisan)) {
            // set the owning side to null (unless already changed)
            if ($artisan->getEtablissement() === $this) {
                $artisan->setEtablissement(null);
            }
        }

        return $this;
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
     * @return Etablissement
     */
    public function setRaisonSocial(?string $raisonSocial): Etablissement
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
     * @return Etablissement
     */
    public function setSigle(?string $sigle): Etablissement
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
     * @return Etablissement
     */
    public function setObjetSocial(?string $objetSocial): Etablissement
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
     * @return Etablissement
     */
    public function setDateDebutActivite(?DateTime $dateDebutActivite): Etablissement
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
     * @return Etablissement
     */
    public function setTypeEntreprise(?string $typeEntreprise): Etablissement
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
     * @return Etablissement
     */
    public function setNumeroRCCM(?string $numeroRCCM): Etablissement
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
     * @return Etablissement
     */
    public function setCapitalSocial(?string $capitalSocial): Etablissement
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
     * @return Etablissement
     */
    public function setRegimeFiscal(?string $regimeFiscal): Etablissement
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
     * @return Etablissement
     */
    public function setNombreAssocie(?string $nombreAssocie): Etablissement
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
     * @return Etablissement
     */
    public function setDureePersonne(?string $dureePersonne): Etablissement
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
     * @return Etablissement
     */
    public function setIdentifiantCnps(?string $identifiantCnps): Etablissement
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
     * @return Etablissement
     */
    public function setNumeroContribuable(?string $numeroContribuable): Etablissement
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
     * @return Etablissement
     */
    public function setAdressPostale(?string $adressPostale): Etablissement
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
     * @return Etablissement
     */
    public function setTelephone(?string $telephone): Etablissement
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
     * @return Etablissement
     */
    public function setFax(?string $fax): Etablissement
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
     * @return Etablissement
     */
    public function setQuartier(?string $quartier): Etablissement
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
     * @return Etablissement
     */
    public function setVillage(?string $village): Etablissement
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
     * @return Etablissement
     */
    public function setLot(?string $lot): Etablissement
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
     * @return Etablissement
     */
    public function setIlot(?string $ilot): Etablissement
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
     * @return Etablissement
     */
    public function setEffectifSalarieHomme(?int $effectifSalarieHomme): Etablissement
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
     * @return Etablissement
     */
    public function setEffectifSalarieFemme(?int $effectifSalarieFemme): Etablissement
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
     * @return Etablissement
     */
    public function setEffectifApprentiHomme(?int $effectifApprentiHomme): Etablissement
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
     * @return Etablissement
     */
    public function setEffectifApprentiFemme(?int $effectifApprentiFemme): Etablissement
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

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): static
    {
        $this->pays = $pays;

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
}
