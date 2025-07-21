<?php

namespace App\DataFixtures;

use App\Entity\CategoryArtisan;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;


class ArtisanCategoryFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $types = [
            "MAÎTRE ARTISAN",
            "COMPAGNON",
            "ENTREPRISE ARTISANALE",
            "APPRENTI"
        ];

        foreach ($types as $type) {
            $category = new CategoryArtisan();
            $category->setName($type);
            $manager->persist($category);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['artisan_group'];
    }

}
