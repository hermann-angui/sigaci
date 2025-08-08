<?php

namespace App\Controller\Api;

use App\DTO\ArtisanRequestDto;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

#[AsController]
class ArtisanImmatriculationController extends AbstractController
{
    public function __invoke(Request $request): ArtisanRequestDto
    {
        $photoFile = $request->files->get('photo');
        $scanDocument = $request->files->get('scanDocuments');
//        $photoPieceIdentiteRectoFile = $request->files->get('photoPieceIdentiteRecto');
//        $photoPieceIdentiteVersoFile = $request->files->get('photoPieceIdentiteVerso');
//        $photoPieceDocumentRectoFile = $request->files->get('photoPieceDocumentRecto');
//        $photoPieceDocumentVersoFile = $request->files->get('photoPieceDocumentVerso');
        if (!$photoFile) {
            throw new BadRequestHttpException('File is required');
        }
//        if (!$scanDocument) {
//            throw new BadRequestHttpException('File is required');
//        }
//        if (!$photoPieceIdentiteVersoFile) {
//            throw new BadRequestHttpException('File is required');
//        }
//        if (!$photoPieceDocumentRectoFile) {
//            throw new BadRequestHttpException('File is required');
//        }
//        if (!$photoPieceDocumentVersoFile) {
//            throw new BadRequestHttpException('File is required');
//        }

        $artisan = new ArtisanRequestDto();

        $artisan->setPhoto($photoFile);
        $artisan->setScanDocument($scanDocument);
        $artisan->setFormationDiplomeObtenu($request->request->get('formationDiplomeObtenu'));
        $artisan->setWhatsapp($request->request->get('whatsapp'));
        $artisan->setQuartier($request->request->get('quartier'));
        $artisan->setDateDelivrancePieceIdentite(new DateTime($request->request->get('dateDelivrancePieceIdentite')));
        $artisan->setFormationApprentissageMetier($request->request->get('formationApprentissageMetier'));
        $artisan->setFormationApprentissageMetierDiplome($request->request->get('formationApprentissageMetierDiplome'));
        $artisan->setAutoriteDelivrancePieceIdentite($request->request->get('autoriteDelivrancePieceIdentite'));
        $artisan->setCategoryArtisanCode($request->request->get('categoryArtisanCode'));
        $artisan->setEmail($request->request->get('email'));
        $artisan->setSexe($request->request->get('sexe'));
        $artisan->setMontant($request->request->get('montant'));
        $artisan->setNom($request->request->get('nom'));
        $artisan->setNumeroPermisConduire($request->request->get('numeroPermisConduire'));
        $artisan->setEtatCivil($request->request->get('etatCivil'));
        $artisan->setDateNaissance(new DateTime($request->request->get('dateNaissance')));
        $artisan->setDomicile($request->request->get('domicile'));
        $artisan->setNumeroRM($request->request->get('numeroRM'));
        $artisan->setCreatedAt(new \DateTime('now'));
        $artisan->setLatitude($request->request->get('latitude'));
        $artisan->setLongitude($request->request->get('longitude'));
        $artisan->setLieuNaissance($request->request->get('lieuNaissance'));
        $artisan->setDateDebutActivitePro(new DateTime($request->request->get('dateDebutActivitePro')));
        $artisan->setCnps($request->request->get('numeroCnps'));
        $artisan->setNationaliteCode($request->request->get('nationaliteCode'));
        $artisan->setTypeEnrolement($request->request->get('typeEnrolement'));
        $artisan->setReferenceExterne($request->request->get('montant'));
        $artisan->setNumeroReferencePaiement($request->request->get('montant'));
        $artisan->setNumeroCarteProfessionnelle($request->request->get('montant'));
        $artisan->setPaysNaissanceCode($request->request->get('montant'));
        $artisan->setVilleNaissanceCode($request->request->get('montant'));

        return $artisan;
    }
}
