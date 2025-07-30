<?php

namespace App\DTO;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\Api\ArtisanImmatriculationController;
use App\State\ArtisanDtoStateProcessor;
use App\State\ArtisanDtoStateProvider;
use DateTimeInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;


class ArtisanResponseDto
{

    public ?string $id = null;                      // Peut être un string UUID ou int

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $email;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $nom;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $sexe;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $prenoms;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?DateTimeInterface $dateNaissance;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $lieuNaissance;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $domicile;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $quartier;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $typePieceIdentite;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $numeroPieceIdentite;

    private ?string $photo = null;


    //#[Groups(['artisan_dto:create'])]
    private ?string $photoPieceIdentiteRecto = null;


    //#[Groups(['artisan_dto:create'])]
    private ?string $photoPieceIdentiteVerso = null;


    //#[Groups(['artisan_dto:create'])]
    private ?string $photoDocumentRecto = null;

    #[Assert\File(
        maxSize: '10M',
        mimeTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/svg'],
    )]
    //#[Groups(['artisan_dto:create'])]
    private ?string $photoDocumentVerso = null;


    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $lieuDelivrancePieceIdentite;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?DateTimeInterface $dateDelivrancePieceIdentite;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $autoriteDelivrancePieceIdentite;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $etatCivil;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $activiteExerceeLieu;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?DateTimeInterface $dateDebutActivite;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?DateTimeInterface $dateDebutActivitePro;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $telephone;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $whatsapp;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $codePostal;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $cnps;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $numeroRM;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $numeroCarteProfessionnelle;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $formationNiveauEtude;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $formationClasseEtude;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $formationDiplomeObtenu;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $formationApprentissageMetier;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $formationApprentissageMetierNiveau;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $formationApprentissageMetierDiplome;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $numeroPermisConduire;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $latitude;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $longitude;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?DateTimeInterface $created_at;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $crmCode;

    private ?int $montant;

    private ?int $code_paiement;

    private ?string $reference_externe;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $categoryArtisan;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $villeNaissanceCode;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $paysNaissanceCode;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $nationaliteCode;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $codeImmatriculation;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $codeIdentification;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $activiteSecondaireCode;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $activiteExerceeCode;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $activitePrincipaleCode;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $entrepriseNumeroIdentification;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $entrepriseNumeroImmatriculation;

    //#[Groups(['artisan_dto:read', 'artisan_dto:create'])]
    private ?string $activiteCode;


}
