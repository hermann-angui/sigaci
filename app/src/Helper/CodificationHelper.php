<?php

namespace App\Helper;

use App\Entity\Artisan;
use DateTime;

class CodificationHelper
{
    public  static function generateCodeIdentification(string $categoryArtisanCode, string $codeCrm, int $orderNumber): ?string
    {
        $date = new DateTime('now');
        return match ($categoryArtisanCode) {
            'EA' => sprintf("ID-REA-%s-%s-%s-%s", $codeCrm, $date->format('y'), $date->format('m'), sprintf("%'.08d", $orderNumber)),
            'MA' => sprintf("ID-RM-%s-%s-%s-%s", $codeCrm, $date->format('y'), $date->format('m'), sprintf("%'.08d", $orderNumber)),
            'CP' => sprintf("ID-CP-%s-%s-%s-%s", $codeCrm, $date->format('y'), $date->format('m'), sprintf("%'.08d", $orderNumber)),
            'AP' => sprintf("ID-AP-%s-%s-%s-%s", $codeCrm, $date->format('y'), $date->format('m'), sprintf("%'.08d", $orderNumber)),
            default => null,
        };
    }

    public static function generateCodeImmatriculation(string $categoryArtisanCode, string $codeCrm, string $abbrCrm, string $sexe, int $orderNumber): ?string
    {
        $date = new DateTime('now');
        return match ($categoryArtisanCode) {
            'EA' => sprintf("%s-REA-%s-%s", $codeCrm, $date->format('y'), sprintf("8d%s", $orderNumber)),
            'MA' => sprintf("%s-RM-%s-%s-%s-%s", $codeCrm, $date->format('y'), $date->format('m'), sprintf("8d%s", $orderNumber), $abbrCrm),
            'CP' => sprintf("CN-%s-%s-%s-%s", $date->format('y'), $date->format('m'), self::getSexeNumber($sexe), sprintf("8d%s", $orderNumber)),
            'AP' => sprintf("AP-%s-%s-%s-%s", $date->format('y'), $date->format('m'), self::getSexeNumber($sexe), sprintf("8d%s", $orderNumber)),
            default => null,
        };
    }

    private static function getSexeNumber($sexe): ?string
    {
        if(in_array(strtolower($sexe), ['h', 'homme', 'male']))  return '01';
        elseif (in_array(strtolower($sexe), ['f', 'femme', 'female']))  return '00';
        return null;
    }
}
