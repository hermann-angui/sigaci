<?php

namespace App\Controller\Api;

use App\Entity\MediaObject;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Vich\UploaderBundle\Storage\StorageInterface;

#[AsController]
class UploadMediaObjectAction
{
    public function __invoke(Request $request, EntityManagerInterface $em, StorageInterface $storage): MediaObject
    {

        /** @var UploadedFile $uploadedFile */
        $uploadedFile = $request->files->get('file');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }

        $size = $uploadedFile->getSize();
        $mimeType = $uploadedFile->getMimeType();
        $type = $uploadedFile->getType();

        $mediaObject = new MediaObject();
        $mediaObject->setSize($size);
        $mediaObject->setMimeType($mimeType);
        $mediaObject->setType($type);
        $em->persist($mediaObject);
        $em->flush();

        return $mediaObject;
    }
}
