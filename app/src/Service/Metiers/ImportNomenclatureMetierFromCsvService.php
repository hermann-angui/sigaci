<?php

namespace App\Service\Metiers;


use App\Entity\BrancheMetier;
use App\Entity\CorpsMetiers;
use App\Entity\Metiers;
use Doctrine\ORM\EntityManagerInterface;
class ImportNomenclatureMetierFromCsvService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function importFromCsv(string $filePath): void
    {
        if (!file_exists($filePath) || !is_readable($filePath)) {
            throw new \RuntimeException("CSV file not found or not readable.");
        }

        $handle = fopen($filePath, 'r');
        fgetcsv($handle, 0, ";"); // skip header

        // To prevent re-querying DB, we use in-memory tracking
        $branches = [];
        $corps = [];

        while (($row = fgetcsv($handle, 0, ";")) !== false) {
            [$brancheId, $brancheLibelle,, $corpsId, $corpsLibelle, $metierLibelle] = $row;

            // ----- BrancheMetier -----
            if (!isset($branches[$brancheId])) {
                $branche = $this->em->getRepository(BrancheMetier::class)->find($brancheId);
                if (!$branche) {
                    $branche = new BrancheMetier();
                    $branche->setId($brancheId);
                    $branche->setName($brancheLibelle);
                    $this->em->persist($branche);
                }
                $branches[$brancheId] = $branche;
            }

            // ----- CorpsMetiers -----
            if (!isset($corps[$corpsId])) {
                $corpsDeMetier = $this->em->getRepository(CorpsMetiers::class)->find($corpsId);
                if (!$corpsDeMetier) {
                    $corpsDeMetier = new CorpsMetiers();
                    $corpsDeMetier->setId($corpsId);
                    $corpsDeMetier->setName($corpsLibelle);
                    $corpsDeMetier->setBrancheMetier($branches[$brancheId]);
                    $this->em->persist($corpsDeMetier);
                }
                $corps[$corpsId] = $corpsDeMetier;
            }

            // ----- Metiers -----
            $existingMetier = $this->em->getRepository(Metiers::class)->findOneBy([
                'name' => $metierLibelle,
                'corpsMetiers' => $corps[$corpsId],
            ]);

            if (!$existingMetier) {
                $metier = new Metiers();
                $metier->setName($metierLibelle);
                $metier->setCorpsMetiers($corps[$corpsId]);
                $this->em->persist($metier);
            }
        }

        try {
            fclose($handle);
            $this->em->flush();
        }catch(\Exception $e){
            echo $e->getMessage();
        }

    }
}
