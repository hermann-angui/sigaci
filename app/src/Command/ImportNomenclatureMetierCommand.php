<?php

namespace App\Command;

use App\Entity\Crm;
use App\Entity\MediaObject;
use App\Entity\User;
use App\Service\Metiers\ImportNomenclatureMetierFromCsvService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'ImportNomenclatureMetierCommand',
    description: 'Add a short description for your command',
)]
class ImportNomenclatureMetierCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $em,
        private ImportNomenclatureMetierFromCsvService $importNomenclatureMetierFromCsvService,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption('path', null, InputOption::VALUE_OPTIONAL, "path to csv files", null);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        if ($input->getOption('path')) $path = $input->getOption('path');
        else $path = "/var/www/html/public/imports/";

        $file = $path . "fichier_import_metiers.csv";
        $this->importNomenclatureMetierFromCsvService->importFromCsv($file);
        $output->writeln('Fichier importé avec succès!');
        return Command::SUCCESS;
    }
}
