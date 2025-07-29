<?php

namespace App\Controller\Api;

use App\Entity\ArtisanDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

#[AsController]
class ArtisanImmatriculationController extends AbstractController
{
    public function __invoke(Request $request): ArtisanDto
    {
        $photoFile = $request->files->get('photo');
//        $photoPieceIdentiteRectoFile = $request->files->get('photoPieceIdentiteRecto');
//        $photoPieceIdentiteVersoFile = $request->files->get('photoPieceIdentiteVerso');
//        $photoPieceDocumentRectoFile = $request->files->get('photoPieceDocumentRecto');
//        $photoPieceDocumentVersoFile = $request->files->get('photoPieceDocumentVerso');
        if (!$photoFile) {
            throw new BadRequestHttpException('File is required');
        }
//        if (!$photoPieceIdentiteRectoFile) {
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

        $artisan = new ArtisanDto();
        $artisan->setPhoto($photoFile);
        $artisan->setPhotoPieceIdentiteRecto($request->request->get('photoPieceIdentiteRecto'));
        $artisan->setPhotoPieceIdentiteVerso($request->request->get('photoPieceIdentiteVerso'));

        $artisan->setPhotoDocumentRecto($request->request->get('photoPieceDocumentRecto'));
        $artisan->setPhotoDocumentVerso($request->request->get('photoPieceDocumentVerso'));

        $artisan->setCategoryArtisan($request->request->get('categoryArtisan'));
        $artisan->setEmail($request->request->get('email'));
        $artisan->setSexe($request->request->get('sexe'));
        $artisan->setMontant($request->request->get('montant'));

        return $artisan;
    }
}
