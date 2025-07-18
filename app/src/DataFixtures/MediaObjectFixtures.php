<?php

namespace App\DataFixtures;

use App\Entity\MediaObject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;


class MediaObjectFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $folder = '/var/www/html/public/artisans'; // Example: 'uploads/images'

        // Get all files (excluding directories and hidden files)
        $files = array_filter(glob($folder . '/*.jpg'), 'is_file');

        foreach ($files as $file) {
            $media = new MediaObject();
            $media->setFilePath(basename($file));
            $media->setMimeType('mime/jpg');
            $media->setType("file");
            $manager->persist($media);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['artisan_mediaobject'];
    }

}
