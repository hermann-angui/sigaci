<?php

namespace App\DataFixtures;

use App\Entity\Crm;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CrmFixtures extends Fixture
{
    private static $crms = [
        "lagunes nord",
        "lagunes sud",
        "lagunes est",
        "abengourou",
        "bondoukou",
        "bouake",
        "daloa",
        "korhogo",
        "man",
        "odienne",
        "san-pedro",
        "yamoussoukro"
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::$crms as $crm) {
            $crmNew = new Crm();
            $crmNew->setName($crm);
            $manager->persist($crmNew);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['artisan_crm'];
    }
}
