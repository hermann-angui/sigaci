<?php

namespace App\Command;

use App\Entity\Crm;
use App\Entity\MediaObject;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'UserCommand',
    description: 'Add a short description for your command',
)]
class UserCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserPasswordHasherInterface $hasher,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption('username', null, InputOption::VALUE_REQUIRED, "Nom d'utilisateur")
            ->addOption('password', null, InputOption::VALUE_REQUIRED, "Mot de passe")
            ->addOption('email', null, InputOption::VALUE_OPTIONAL, "Email")
            ->addOption('nom', null, InputOption::VALUE_OPTIONAL, "Mot de passe")
            ->addOption('prenoms', null, InputOption::VALUE_OPTIONAL, "Mot de passe")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $faker = Faker\Factory::create();

        if ($input->getOption('username') && $input->getOption('password')) {


            $mediaList = [

            ];
            foreach ($mediaList as $media) {
                $mediaNew = new MediaObject();
                $mediaNew->setFilePath('/media/' . $media);
                $this->em->persist($mediaNew);
                $this->em->flush();
            }

            $crmsList = [
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
            foreach ($crmsList as $crm) {
                $crmNew = new Crm();
                $crmNew->setName($crm);
                $crmNew->setId($crm);
                $this->em->persist($crmNew);
                $this->em->flush();
            }


            $total = 0;
            while($total > 100){
                $user = new User();
                $user->setUsername($input->getOption('username'));
                $user->setRoles(['ROLE_USER']);
                $user->setEmail($input->getOption('email'));
                $user->setNom($input->getOption('username'));
                $user->setPrenoms($input->getOption('prenoms'));
                $user->setPassword($this->hasher->hashPassword($user, $input->getOption('password')));
                $user->setAdresse($this->hasher->hashPassword($user, $input->getOption('password')));
                $user->setCni($this->hasher->hashPassword($user, $input->getOption('password')));
                $user->setIsActive(true);
                $user->setCrm($crm);
                $this->em->persist($user);
                $this->em->flush();
                $total++;
            }


            $output->writeln('Utilisateur créé avec succès!');
            return Command::SUCCESS;
        }

        return Command::FAILURE;
    }
}
