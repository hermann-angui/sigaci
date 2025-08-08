<?php

namespace App\DTO;

use DateTime;
use DateTimeInterface;

class EntrepriseResponseDto
{

    public ?string $id = null;

    private ?string $email;

    private ?string $nom;

    private ?string $sexe;

    private ?string $prenoms;

    private ?DateTime $dateNaissance;

    private ?string $lieuNaissance;

    private ?string $domicile;

    private ?string $quartier;

    private ?string $typePieceIdentite;

    private ?string $numeroPieceIdentite;

    private ?string $photo = null;

    private ?string $scanDocument = null;

    private ?string $lieuDelivrancePieceIdentite;

    private ?DateTimeInterface $dateDelivrancePieceIdentite;

    private ?string $autoriteDelivrancePieceIdentite;

    private ?string $etatCivil;

    private ?string $activiteExerceeLieu;

    private ?DateTimeInterface $dateDebutActivite;

    private ?DateTimeInterface $dateDebutActivitePro;

    private ?string $telephone;

    private ?string $whatsapp;

    private ?string $codePostal;

    private ?string $cnps;

    private ?string $numeroRM;

    private ?string $numeroCarteProfessionnelle;

    private ?string $formationNiveauEtude;

    private ?string $formationClasseEtude;

    private ?string $formationDiplomeObtenu;

    private ?string $formationApprentissageMetier;

    private ?string $formationApprentissageMetierNiveau;

    private ?string $formationApprentissageMetierDiplome;

    private ?string $latitude;

    private ?string $longitude;

    private ?DateTimeInterface $created_at;

    private ?string $crmCode;

    private ?int $montant;

    private ?int $codePaiement;

    private ?string $reference_externe;

    private ?string $categoryArtisanCode;

    private ?string $villeNaissanceCode;

    private ?string $paysNaissanceCode;

    private ?string $nationaliteCode;

    private ?string $codeImmatriculation;

    private ?string $codeIdentification;

    private ?string $activiteSecondaireCode;

    private ?string $activiteExerceeCode;

    private ?string $activitePrincipaleCode;

    private ?string $entrepriseNumeroIdentification;

    private ?string $entrepriseNumeroImmatriculation;

    private ?string $activiteCode;

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     * @return EntrepriseResponseDto
     */
    public function setId(?string $id): EntrepriseResponseDto
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return EntrepriseResponseDto
     */
    public function setEmail(?string $email): EntrepriseResponseDto
    {
        $this->email = $email;
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
     * @return EntrepriseResponseDto
     */
    public function setNom(?string $nom): EntrepriseResponseDto
    {
        $this->nom = $nom;
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
     * @return EntrepriseResponseDto
     */
    public function setSexe(?string $sexe): EntrepriseResponseDto
    {
        $this->sexe = $sexe;
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
     * @return EntrepriseResponseDto
     */
    public function setPrenoms(?string $prenoms): EntrepriseResponseDto
    {
        $this->prenoms = $prenoms;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateNaissance(): ?DateTimeInterface
    {
        return $this->dateNaissance;
    }

    /**
     * @param DateTimeInterface|null $dateNaissance
     * @return EntrepriseResponseDto
     */
    public function setDateNaissance(?DateTimeInterface $dateNaissance): EntrepriseResponseDto
    {
        $this->dateNaissance = $dateNaissance;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLieuNaissance(): ?string
    {
        return $this->lieuNaissance;
    }

    /**
     * @param string|null $lieuNaissance
     * @return EntrepriseResponseDto
     */
    public function setLieuNaissance(?string $lieuNaissance): EntrepriseResponseDto
    {
        $this->lieuNaissance = $lieuNaissance;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDomicile(): ?string
    {
        return $this->domicile;
    }

    /**
     * @param string|null $domicile
     * @return EntrepriseResponseDto
     */
    public function setDomicile(?string $domicile): EntrepriseResponseDto
    {
        $this->domicile = $domicile;
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
     * @return EntrepriseResponseDto
     */
    public function setQuartier(?string $quartier): EntrepriseResponseDto
    {
        $this->quartier = $quartier;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTypePieceIdentite(): ?string
    {
        return $this->typePieceIdentite;
    }

    /**
     * @param string|null $typePieceIdentite
     * @return EntrepriseResponseDto
     */
    public function setTypePieceIdentite(?string $typePieceIdentite): EntrepriseResponseDto
    {
        $this->typePieceIdentite = $typePieceIdentite;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumeroPieceIdentite(): ?string
    {
        return $this->numeroPieceIdentite;
    }

    /**
     * @param string|null $numeroPieceIdentite
     * @return EntrepriseResponseDto
     */
    public function setNumeroPieceIdentite(?string $numeroPieceIdentite): EntrepriseResponseDto
    {
        $this->numeroPieceIdentite = $numeroPieceIdentite;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    /**
     * @param string|null $photo
     * @return EntrepriseResponseDto
     */
    public function setPhoto(?string $photo): EntrepriseResponseDto
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getScanDocument(): ?string
    {
        return $this->scanDocument;
    }

    /**
     * @param string|null $scanDocument
     * @return EntrepriseResponseDto
     */
    public function setScanDocument(?string $scanDocument): EntrepriseResponseDto
    {
        $this->scanDocument = $scanDocument;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLieuDelivrancePieceIdentite(): ?string
    {
        return $this->lieuDelivrancePieceIdentite;
    }

    /**
     * @param string|null $lieuDelivrancePieceIdentite
     * @return EntrepriseResponseDto
     */
    public function setLieuDelivrancePieceIdentite(?string $lieuDelivrancePieceIdentite): EntrepriseResponseDto
    {
        $this->lieuDelivrancePieceIdentite = $lieuDelivrancePieceIdentite;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateDelivrancePieceIdentite(): ?DateTimeInterface
    {
        return $this->dateDelivrancePieceIdentite;
    }

    /**
     * @param DateTimeInterface|null $dateDelivrancePieceIdentite
     * @return EntrepriseResponseDto
     */
    public function setDateDelivrancePieceIdentite(?DateTimeInterface $dateDelivrancePieceIdentite): EntrepriseResponseDto
    {
        $this->dateDelivrancePieceIdentite = $dateDelivrancePieceIdentite;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAutoriteDelivrancePieceIdentite(): ?string
    {
        return $this->autoriteDelivrancePieceIdentite;
    }

    /**
     * @param string|null $autoriteDelivrancePieceIdentite
     * @return EntrepriseResponseDto
     */
    public function setAutoriteDelivrancePieceIdentite(?string $autoriteDelivrancePieceIdentite): EntrepriseResponseDto
    {
        $this->autoriteDelivrancePieceIdentite = $autoriteDelivrancePieceIdentite;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEtatCivil(): ?string
    {
        return $this->etatCivil;
    }

    /**
     * @param string|null $etatCivil
     * @return EntrepriseResponseDto
     */
    public function setEtatCivil(?string $etatCivil): EntrepriseResponseDto
    {
        $this->etatCivil = $etatCivil;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getActiviteExerceeLieu(): ?string
    {
        return $this->activiteExerceeLieu;
    }

    /**
     * @param string|null $activiteExerceeLieu
     * @return EntrepriseResponseDto
     */
    public function setActiviteExerceeLieu(?string $activiteExerceeLieu): EntrepriseResponseDto
    {
        $this->activiteExerceeLieu = $activiteExerceeLieu;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateDebutActivite(): ?DateTimeInterface
    {
        return $this->dateDebutActivite;
    }

    /**
     * @param DateTimeInterface|null $dateDebutActivite
     * @return EntrepriseResponseDto
     */
    public function setDateDebutActivite(?DateTimeInterface $dateDebutActivite): EntrepriseResponseDto
    {
        $this->dateDebutActivite = $dateDebutActivite;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateDebutActivitePro(): ?DateTimeInterface
    {
        return $this->dateDebutActivitePro;
    }

    /**
     * @param DateTimeInterface|null $dateDebutActivitePro
     * @return EntrepriseResponseDto
     */
    public function setDateDebutActivitePro(?DateTimeInterface $dateDebutActivitePro): EntrepriseResponseDto
    {
        $this->dateDebutActivitePro = $dateDebutActivitePro;
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
     * @return EntrepriseResponseDto
     */
    public function setTelephone(?string $telephone): EntrepriseResponseDto
    {
        $this->telephone = $telephone;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWhatsapp(): ?string
    {
        return $this->whatsapp;
    }

    /**
     * @param string|null $whatsapp
     * @return EntrepriseResponseDto
     */
    public function setWhatsapp(?string $whatsapp): EntrepriseResponseDto
    {
        $this->whatsapp = $whatsapp;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    /**
     * @param string|null $codePostal
     * @return EntrepriseResponseDto
     */
    public function setCodePostal(?string $codePostal): EntrepriseResponseDto
    {
        $this->codePostal = $codePostal;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCnps(): ?string
    {
        return $this->cnps;
    }

    /**
     * @param string|null $cnps
     * @return EntrepriseResponseDto
     */
    public function setCnps(?string $cnps): EntrepriseResponseDto
    {
        $this->cnps = $cnps;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumeroRM(): ?string
    {
        return $this->numeroRM;
    }

    /**
     * @param string|null $numeroRM
     * @return EntrepriseResponseDto
     */
    public function setNumeroRM(?string $numeroRM): EntrepriseResponseDto
    {
        $this->numeroRM = $numeroRM;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumeroCarteProfessionnelle(): ?string
    {
        return $this->numeroCarteProfessionnelle;
    }

    /**
     * @param string|null $numeroCarteProfessionnelle
     * @return EntrepriseResponseDto
     */
    public function setNumeroCarteProfessionnelle(?string $numeroCarteProfessionnelle): EntrepriseResponseDto
    {
        $this->numeroCarteProfessionnelle = $numeroCarteProfessionnelle;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFormationNiveauEtude(): ?string
    {
        return $this->formationNiveauEtude;
    }

    /**
     * @param string|null $formationNiveauEtude
     * @return EntrepriseResponseDto
     */
    public function setFormationNiveauEtude(?string $formationNiveauEtude): EntrepriseResponseDto
    {
        $this->formationNiveauEtude = $formationNiveauEtude;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFormationClasseEtude(): ?string
    {
        return $this->formationClasseEtude;
    }

    /**
     * @param string|null $formationClasseEtude
     * @return EntrepriseResponseDto
     */
    public function setFormationClasseEtude(?string $formationClasseEtude): EntrepriseResponseDto
    {
        $this->formationClasseEtude = $formationClasseEtude;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFormationDiplomeObtenu(): ?string
    {
        return $this->formationDiplomeObtenu;
    }

    /**
     * @param string|null $formationDiplomeObtenu
     * @return EntrepriseResponseDto
     */
    public function setFormationDiplomeObtenu(?string $formationDiplomeObtenu): EntrepriseResponseDto
    {
        $this->formationDiplomeObtenu = $formationDiplomeObtenu;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFormationApprentissageMetier(): ?string
    {
        return $this->formationApprentissageMetier;
    }

    /**
     * @param string|null $formationApprentissageMetier
     * @return EntrepriseResponseDto
     */
    public function setFormationApprentissageMetier(?string $formationApprentissageMetier): EntrepriseResponseDto
    {
        $this->formationApprentissageMetier = $formationApprentissageMetier;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFormationApprentissageMetierNiveau(): ?string
    {
        return $this->formationApprentissageMetierNiveau;
    }

    /**
     * @param string|null $formationApprentissageMetierNiveau
     * @return EntrepriseResponseDto
     */
    public function setFormationApprentissageMetierNiveau(?string $formationApprentissageMetierNiveau): EntrepriseResponseDto
    {
        $this->formationApprentissageMetierNiveau = $formationApprentissageMetierNiveau;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFormationApprentissageMetierDiplome(): ?string
    {
        return $this->formationApprentissageMetierDiplome;
    }

    /**
     * @param string|null $formationApprentissageMetierDiplome
     * @return EntrepriseResponseDto
     */
    public function setFormationApprentissageMetierDiplome(?string $formationApprentissageMetierDiplome): EntrepriseResponseDto
    {
        $this->formationApprentissageMetierDiplome = $formationApprentissageMetierDiplome;
        return $this;
    }



    /**
     * @return string|null
     */
    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    /**
     * @param string|null $latitude
     * @return EntrepriseResponseDto
     */
    public function setLatitude(?string $latitude): EntrepriseResponseDto
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    /**
     * @param string|null $longitude
     * @return EntrepriseResponseDto
     */
    public function setLongitude(?string $longitude): EntrepriseResponseDto
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->created_at;
    }

    /**
     * @param DateTimeInterface|null $created_at
     * @return EntrepriseResponseDto
     */
    public function setCreatedAt(?DateTimeInterface $created_at): EntrepriseResponseDto
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCrmCode(): ?string
    {
        return $this->crmCode;
    }

    /**
     * @param string|null $crmCode
     * @return EntrepriseResponseDto
     */
    public function setCrmCode(?string $crmCode): EntrepriseResponseDto
    {
        $this->crmCode = $crmCode;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMontant(): ?int
    {
        return $this->montant;
    }

    /**
     * @param int|null $montant
     * @return EntrepriseResponseDto
     */
    public function setMontant(?int $montant): EntrepriseResponseDto
    {
        $this->montant = $montant;
        return $this;
    }


    /**
     * @return int|null
     */
    public function getCodePaiement(): ?int
    {
        return $this->codePaiement;
    }

    /**
     * @param int|null $codePaiement
     * @return EntrepriseResponseDto
     */
    public function setCodePaiement(?int $codePaiement): EntrepriseResponseDto
    {
        $this->codePaiement = $codePaiement;
        return $this;
    }


    /**
     * @return string|null
     */
    public function getReferenceExterne(): ?string
    {
        return $this->reference_externe;
    }

    /**
     * @param string|null $reference_externe
     * @return EntrepriseResponseDto
     */
    public function setReferenceExterne(?string $reference_externe): EntrepriseResponseDto
    {
        $this->reference_externe = $reference_externe;
        return $this;
    }


    /**
     * @return string|null
     */
    public function getVilleNaissanceCode(): ?string
    {
        return $this->villeNaissanceCode;
    }

    /**
     * @param string|null $villeNaissanceCode
     * @return EntrepriseResponseDto
     */
    public function setVilleNaissanceCode(?string $villeNaissanceCode): EntrepriseResponseDto
    {
        $this->villeNaissanceCode = $villeNaissanceCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaysNaissanceCode(): ?string
    {
        return $this->paysNaissanceCode;
    }

    /**
     * @param string|null $paysNaissanceCode
     * @return EntrepriseResponseDto
     */
    public function setPaysNaissanceCode(?string $paysNaissanceCode): EntrepriseResponseDto
    {
        $this->paysNaissanceCode = $paysNaissanceCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNationaliteCode(): ?string
    {
        return $this->nationaliteCode;
    }

    /**
     * @param string|null $nationaliteCode
     * @return EntrepriseResponseDto
     */
    public function setNationaliteCode(?string $nationaliteCode): EntrepriseResponseDto
    {
        $this->nationaliteCode = $nationaliteCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCodeImmatriculation(): ?string
    {
        return $this->codeImmatriculation;
    }

    /**
     * @param string|null $codeImmatriculation
     * @return EntrepriseResponseDto
     */
    public function setCodeImmatriculation(?string $codeImmatriculation): EntrepriseResponseDto
    {
        $this->codeImmatriculation = $codeImmatriculation;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCodeIdentification(): ?string
    {
        return $this->codeIdentification;
    }

    /**
     * @param string|null $codeIdentification
     * @return EntrepriseResponseDto
     */
    public function setCodeIdentification(?string $codeIdentification): EntrepriseResponseDto
    {
        $this->codeIdentification = $codeIdentification;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getActiviteSecondaireCode(): ?string
    {
        return $this->activiteSecondaireCode;
    }

    /**
     * @param string|null $activiteSecondaireCode
     * @return EntrepriseResponseDto
     */
    public function setActiviteSecondaireCode(?string $activiteSecondaireCode): EntrepriseResponseDto
    {
        $this->activiteSecondaireCode = $activiteSecondaireCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getActiviteExerceeCode(): ?string
    {
        return $this->activiteExerceeCode;
    }

    /**
     * @param string|null $activiteExerceeCode
     * @return EntrepriseResponseDto
     */
    public function setActiviteExerceeCode(?string $activiteExerceeCode): EntrepriseResponseDto
    {
        $this->activiteExerceeCode = $activiteExerceeCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getActivitePrincipaleCode(): ?string
    {
        return $this->activitePrincipaleCode;
    }

    /**
     * @param string|null $activitePrincipaleCode
     * @return EntrepriseResponseDto
     */
    public function setActivitePrincipaleCode(?string $activitePrincipaleCode): EntrepriseResponseDto
    {
        $this->activitePrincipaleCode = $activitePrincipaleCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEntrepriseNumeroIdentification(): ?string
    {
        return $this->entrepriseNumeroIdentification;
    }

    /**
     * @param string|null $entrepriseNumeroIdentification
     * @return EntrepriseResponseDto
     */
    public function setEntrepriseNumeroIdentification(?string $entrepriseNumeroIdentification): EntrepriseResponseDto
    {
        $this->entrepriseNumeroIdentification = $entrepriseNumeroIdentification;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEntrepriseNumeroImmatriculation(): ?string
    {
        return $this->entrepriseNumeroImmatriculation;
    }

    /**
     * @param string|null $entrepriseNumeroImmatriculation
     * @return EntrepriseResponseDto
     */
    public function setEntrepriseNumeroImmatriculation(?string $entrepriseNumeroImmatriculation): EntrepriseResponseDto
    {
        $this->entrepriseNumeroImmatriculation = $entrepriseNumeroImmatriculation;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getActiviteCode(): ?string
    {
        return $this->activiteCode;
    }

    /**
     * @param string|null $activiteCode
     * @return EntrepriseResponseDto
     */
    public function setActiviteCode(?string $activiteCode): EntrepriseResponseDto
    {
        $this->activiteCode = $activiteCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCategoryArtisanCode(): ?string
    {
        return $this->categoryArtisanCode;
    }

    /**
     * @param string|null $categoryArtisanCode
     * @return EntrepriseResponseDto
     */
    public function setCategoryArtisanCode(?string $categoryArtisanCode): EntrepriseResponseDto
    {
        $this->categoryArtisanCode = $categoryArtisanCode;
        return $this;
    }

}
