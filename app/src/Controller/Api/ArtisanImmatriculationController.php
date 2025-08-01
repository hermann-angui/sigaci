<?php

namespace App\Controller\Api;

use App\DTO\ArtisanRequestDto;
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
        if (!$scanDocument) {
            throw new BadRequestHttpException('File is required');
        }
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
        $artisan->setScanDocument($request->request->get('scanDocument'));
        $artisan->setCategoryArtisanCode($request->request->get('categoryArtisanCode'));
        $artisan->setEmail($request->request->get('email'));
        $artisan->setSexe($request->request->get('sexe'));
        $artisan->setMontant($request->request->get('montant'));

        return $artisan;
    }
}
