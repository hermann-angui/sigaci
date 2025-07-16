<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EtablissementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $primaryactivity;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $activitystartdate;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $secondaryactivity;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $companyname;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $companyacronym;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $companypurpose;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $companylegalstatus;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $numregistremetier;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $numrea;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $numrccm;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $companycapitalsocial;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $companyregimefiscal;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $companynumcnps;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $companynombreassocies;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $companyduree;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $companytaxpayernumber;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $companyadressepostale;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $companytel;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $companyfax;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $companydepartement;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $companycommune;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $companysp;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $companyquartier;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $companyvillage;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $companylotnumber;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $companyilotnumber;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $companyeffectsalariehomme;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $companyeffectsalariefemme;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $companyeffectapprentishomme;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $companyeffectepprentishomme;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $companyeffectapprentisfemme;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $activitylocation;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $activityLocation;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $activitycountry;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $activitycity;
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $activityquartier;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $latitude;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $longitude;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\ManyToOne(inversedBy: 'etablissements')]
    private ?Crm $crm = null;

    #[ORM\OneToMany(mappedBy: 'etablissement', targetEntity: Artisan::class)]
    private Collection $artisans;

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

    public function getPrimaryactivity(): ?string
    {
        return $this->primaryactivity;
    }

    public function setPrimaryactivity(?string $primaryactivity): void
    {
        $this->primaryactivity = $primaryactivity;
    }

    public function getActivitystartdate(): ?string
    {
        return $this->activitystartdate;
    }

    public function setActivitystartdate(?string $activitystartdate): void
    {
        $this->activitystartdate = $activitystartdate;
    }

    public function getSecondaryactivity(): ?string
    {
        return $this->secondaryactivity;
    }

    public function setSecondaryactivity(?string $secondaryactivity): void
    {
        $this->secondaryactivity = $secondaryactivity;
    }

    public function getCompanyname(): ?string
    {
        return $this->companyname;
    }

    public function setCompanyname(?string $companyname): void
    {
        $this->companyname = $companyname;
    }

    public function getCompanyacronym(): ?string
    {
        return $this->companyacronym;
    }

    public function setCompanyacronym(?string $companyacronym): void
    {
        $this->companyacronym = $companyacronym;
    }

    public function getCompanypurpose(): ?string
    {
        return $this->companypurpose;
    }

    public function setCompanypurpose(?string $companypurpose): void
    {
        $this->companypurpose = $companypurpose;
    }

    public function getCompanylegalstatus(): ?string
    {
        return $this->companylegalstatus;
    }

    public function setCompanylegalstatus(?string $companylegalstatus): void
    {
        $this->companylegalstatus = $companylegalstatus;
    }

    public function getNumregistremetier(): ?string
    {
        return $this->numregistremetier;
    }

    public function setNumregistremetier(?string $numregistremetier): void
    {
        $this->numregistremetier = $numregistremetier;
    }

    public function getNumrea(): ?string
    {
        return $this->numrea;
    }

    public function setNumrea(?string $numrea): void
    {
        $this->numrea = $numrea;
    }

    public function getNumrccm(): ?string
    {
        return $this->numrccm;
    }

    public function setNumrccm(?string $numrccm): void
    {
        $this->numrccm = $numrccm;
    }

    public function getCompanycapitalsocial(): ?string
    {
        return $this->companycapitalsocial;
    }

    public function setCompanycapitalsocial(?string $companycapitalsocial): void
    {
        $this->companycapitalsocial = $companycapitalsocial;
    }

    public function getCompanyregimefiscal(): ?string
    {
        return $this->companyregimefiscal;
    }

    public function setCompanyregimefiscal(?string $companyregimefiscal): void
    {
        $this->companyregimefiscal = $companyregimefiscal;
    }

    public function getCompanynumcnps(): ?string
    {
        return $this->companynumcnps;
    }

    public function setCompanynumcnps(?string $companynumcnps): void
    {
        $this->companynumcnps = $companynumcnps;
    }

    public function getCompanynombreassocies(): ?string
    {
        return $this->companynombreassocies;
    }

    public function setCompanynombreassocies(?string $companynombreassocies): void
    {
        $this->companynombreassocies = $companynombreassocies;
    }

    public function getCompanyduree(): ?string
    {
        return $this->companyduree;
    }

    public function setCompanyduree(?string $companyduree): void
    {
        $this->companyduree = $companyduree;
    }

    public function getCompanytaxpayernumber(): ?string
    {
        return $this->companytaxpayernumber;
    }

    public function setCompanytaxpayernumber(?string $companytaxpayernumber): void
    {
        $this->companytaxpayernumber = $companytaxpayernumber;
    }

    public function getCompanyadressepostale(): ?string
    {
        return $this->companyadressepostale;
    }

    public function setCompanyadressepostale(?string $companyadressepostale): void
    {
        $this->companyadressepostale = $companyadressepostale;
    }

    public function getCompanytel(): ?string
    {
        return $this->companytel;
    }

    public function setCompanytel(?string $companytel): void
    {
        $this->companytel = $companytel;
    }

    public function getCompanyfax(): ?string
    {
        return $this->companyfax;
    }

    public function setCompanyfax(?string $companyfax): void
    {
        $this->companyfax = $companyfax;
    }

    public function getCompanydepartement(): ?string
    {
        return $this->companydepartement;
    }

    public function setCompanydepartement(?string $companydepartement): void
    {
        $this->companydepartement = $companydepartement;
    }

    public function getCompanycommune(): ?string
    {
        return $this->companycommune;
    }

    public function setCompanycommune(?string $companycommune): void
    {
        $this->companycommune = $companycommune;
    }

    public function getCompanysp(): ?string
    {
        return $this->companysp;
    }

    public function setCompanysp(?string $companysp): void
    {
        $this->companysp = $companysp;
    }

    public function getCompanyquartier(): ?string
    {
        return $this->companyquartier;
    }

    public function setCompanyquartier(?string $companyquartier): void
    {
        $this->companyquartier = $companyquartier;
    }

    public function getCompanyvillage(): ?string
    {
        return $this->companyvillage;
    }

    public function setCompanyvillage(?string $companyvillage): void
    {
        $this->companyvillage = $companyvillage;
    }

    public function getCompanylotnumber(): ?string
    {
        return $this->companylotnumber;
    }

    public function setCompanylotnumber(?string $companylotnumber): void
    {
        $this->companylotnumber = $companylotnumber;
    }

    public function getCompanyilotnumber(): ?string
    {
        return $this->companyilotnumber;
    }

    public function setCompanyilotnumber(?string $companyilotnumber): void
    {
        $this->companyilotnumber = $companyilotnumber;
    }

    public function getCompanyeffectsalariehomme(): ?string
    {
        return $this->companyeffectsalariehomme;
    }

    public function setCompanyeffectsalariehomme(?string $companyeffectsalariehomme): void
    {
        $this->companyeffectsalariehomme = $companyeffectsalariehomme;
    }

    public function getCompanyeffectsalariefemme(): ?string
    {
        return $this->companyeffectsalariefemme;
    }

    public function setCompanyeffectsalariefemme(?string $companyeffectsalariefemme): void
    {
        $this->companyeffectsalariefemme = $companyeffectsalariefemme;
    }

    public function getCompanyeffectapprentishomme(): ?string
    {
        return $this->companyeffectapprentishomme;
    }

    public function setCompanyeffectapprentishomme(?string $companyeffectapprentishomme): void
    {
        $this->companyeffectapprentishomme = $companyeffectapprentishomme;
    }

    public function getCompanyeffectepprentishomme(): ?string
    {
        return $this->companyeffectepprentishomme;
    }

    public function setCompanyeffectepprentishomme(?string $companyeffectepprentishomme): void
    {
        $this->companyeffectepprentishomme = $companyeffectepprentishomme;
    }

    public function getCompanyeffectapprentisfemme(): ?string
    {
        return $this->companyeffectapprentisfemme;
    }

    public function setCompanyeffectapprentisfemme(?string $companyeffectapprentisfemme): void
    {
        $this->companyeffectapprentisfemme = $companyeffectapprentisfemme;
    }

    public function getActivitylocation(): ?string
    {
        return $this->activitylocation;
    }

    public function setActivitylocation(?string $activitylocation): void
    {
        $this->activitylocation = $activitylocation;
    }


    public function getActivitycountry(): ?string
    {
        return $this->activitycountry;
    }

    public function setActivitycountry(?string $activitycountry): void
    {
        $this->activitycountry = $activitycountry;
    }

    public function getActivitycity(): ?string
    {
        return $this->activitycity;
    }

    public function setActivitycity(?string $activitycity): void
    {
        $this->activitycity = $activitycity;
    }

    public function getActivityquartier(): ?string
    {
        return $this->activityquartier;
    }

    public function setActivityquartier(?string $activityquartier): void
    {
        $this->activityquartier = $activityquartier;
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

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): void
    {
        $this->category = $category;
    }



}
