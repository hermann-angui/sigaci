<?php

namespace App\DTO;

class ArtisanResponseDto
{

    public ?string $id = null;

    private ?string $email;

    private ?string $nom;

    private ?string $sexe;

    private ?string $prenoms;

    private ?DateTimeInterface $dateNaissance;

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

    private ?string $numeroPermisConduire;

    private ?string $latitude;

    private ?string $longitude;

    private ?DateTimeInterface $created_at;

    private ?string $crmCode;

    private ?int $montant;

    private ?int $code_paiement;

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
     * @return ArtisanResponseDto
     */
    public function setId(?string $id): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setEmail(?string $email): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setNom(?string $nom): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setSexe(?string $sexe): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setPrenoms(?string $prenoms): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setDateNaissance(?DateTimeInterface $dateNaissance): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setLieuNaissance(?string $lieuNaissance): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setDomicile(?string $domicile): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setQuartier(?string $quartier): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setTypePieceIdentite(?string $typePieceIdentite): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setNumeroPieceIdentite(?string $numeroPieceIdentite): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setPhoto(?string $photo): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setScanDocument(?string $scanDocument): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setLieuDelivrancePieceIdentite(?string $lieuDelivrancePieceIdentite): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setDateDelivrancePieceIdentite(?DateTimeInterface $dateDelivrancePieceIdentite): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setAutoriteDelivrancePieceIdentite(?string $autoriteDelivrancePieceIdentite): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setEtatCivil(?string $etatCivil): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setActiviteExerceeLieu(?string $activiteExerceeLieu): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setDateDebutActivite(?DateTimeInterface $dateDebutActivite): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setDateDebutActivitePro(?DateTimeInterface $dateDebutActivitePro): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setTelephone(?string $telephone): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setWhatsapp(?string $whatsapp): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setCodePostal(?string $codePostal): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setCnps(?string $cnps): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setNumeroRM(?string $numeroRM): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setNumeroCarteProfessionnelle(?string $numeroCarteProfessionnelle): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setFormationNiveauEtude(?string $formationNiveauEtude): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setFormationClasseEtude(?string $formationClasseEtude): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setFormationDiplomeObtenu(?string $formationDiplomeObtenu): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setFormationApprentissageMetier(?string $formationApprentissageMetier): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setFormationApprentissageMetierNiveau(?string $formationApprentissageMetierNiveau): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setFormationApprentissageMetierDiplome(?string $formationApprentissageMetierDiplome): ArtisanResponseDto
    {
        $this->formationApprentissageMetierDiplome = $formationApprentissageMetierDiplome;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumeroPermisConduire(): ?string
    {
        return $this->numeroPermisConduire;
    }

    /**
     * @param string|null $numeroPermisConduire
     * @return ArtisanResponseDto
     */
    public function setNumeroPermisConduire(?string $numeroPermisConduire): ArtisanResponseDto
    {
        $this->numeroPermisConduire = $numeroPermisConduire;
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
     * @return ArtisanResponseDto
     */
    public function setLatitude(?string $latitude): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setLongitude(?string $longitude): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setCreatedAt(?DateTimeInterface $created_at): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setCrmCode(?string $crmCode): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setMontant(?int $montant): ArtisanResponseDto
    {
        $this->montant = $montant;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCodePaiement(): ?int
    {
        return $this->code_paiement;
    }

    /**
     * @param int|null $code_paiement
     * @return ArtisanResponseDto
     */
    public function setCodePaiement(?int $code_paiement): ArtisanResponseDto
    {
        $this->code_paiement = $code_paiement;
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
     * @return ArtisanResponseDto
     */
    public function setReferenceExterne(?string $reference_externe): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setVilleNaissanceCode(?string $villeNaissanceCode): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setPaysNaissanceCode(?string $paysNaissanceCode): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setNationaliteCode(?string $nationaliteCode): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setCodeImmatriculation(?string $codeImmatriculation): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setCodeIdentification(?string $codeIdentification): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setActiviteSecondaireCode(?string $activiteSecondaireCode): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setActiviteExerceeCode(?string $activiteExerceeCode): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setActivitePrincipaleCode(?string $activitePrincipaleCode): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setEntrepriseNumeroIdentification(?string $entrepriseNumeroIdentification): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setEntrepriseNumeroImmatriculation(?string $entrepriseNumeroImmatriculation): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setActiviteCode(?string $activiteCode): ArtisanResponseDto
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
     * @return ArtisanResponseDto
     */
    public function setCategoryArtisanCode(?string $categoryArtisanCode): ArtisanResponseDto
    {
        $this->categoryArtisanCode = $categoryArtisanCode;
        return $this;
    }

}
