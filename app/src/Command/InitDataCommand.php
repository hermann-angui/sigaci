<?php

namespace App\Command;

use App\Entity\Artisan;
use App\Entity\CategoryArtisan;
use App\Entity\Communes;
use App\Entity\CorpsMetiers;
use App\Entity\Crm;
use App\Entity\EquipeAgent;
use App\Entity\Entreprise;
use App\Entity\Identification;
use App\Entity\Immatriculation;
use App\Entity\MediaObject;
use App\Entity\Metiers;
use App\Entity\Nationalities;
use App\Entity\Payment;
use App\Entity\Pays;
use App\Entity\User;
use App\Entity\Villes;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpSpreadsheet\Calculation\Category;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;
use Symfony\Component\Uid\Uuid;

#[AsCommand(
    name: 'InitDataCommand',
    description: 'Add a short description for your command',
)]
class InitDataCommand extends Command
{

    const USER_COUNT = 30;
    const EQUIPE_COUNT = 10;
    const ARTISAN_COUNT = 200;

    public function __construct(
        private EntityManagerInterface $em,
        private UserPasswordHasherInterface $hasher,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption('mediaobjects', null, InputOption::VALUE_REQUIRED, "Media", 0)
            ->addOption('departements', null, InputOption::VALUE_OPTIONAL, "Departements", 0)
            ->addOption('metiers', null, InputOption::VALUE_OPTIONAL, "Metiers", 0)
            ->addOption('crms', null, InputOption::VALUE_OPTIONAL, "crms", 0)
            ->addOption('equipes', null, InputOption::VALUE_OPTIONAL, "Equipes", 0)
            ->addOption('users', null, InputOption::VALUE_REQUIRED, "Users", 0)
            ->addOption('artisans', null, InputOption::VALUE_REQUIRED, "Users", 0)
            ->addOption('category_artisans', null, InputOption::VALUE_OPTIONAL, "Villes", 0)
            ->addOption('immatriculations', null, InputOption::VALUE_OPTIONAL, "Villes", 0)
            ->addOption('identifications', null, InputOption::VALUE_OPTIONAL, "Villes", 0)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $this->faker = Factory::create();

        if ($input->getOption('crms')) {
             $this->loadCrmsData();
        }

        if ($input->getOption('mediaobjects')) {
            $this->loadMediaObjectData();
        }

        if ($input->getOption('users')) {
            $this->loadUsersData();
        }

        if ($input->getOption('category_artisans')) {
            $this->loadCategoryArtisanData();
        }

        if ($input->getOption('artisans')) {
                $this->loadArtisanData();
        }

        if ($input->getOption('identifications')) {
                $this->loadIdentificationsData();
        }

        if ($input->getOption('immatriculations')) {
            $this->loadImmatriculationsData();
        }


        $output->writeln('Utilisateur créé avec succès!');
        return Command::SUCCESS;
    }

    private function loadCrmsData(): void {
        $crms = [
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

        foreach ($crms as $crm) {
            $crmNew = new Crm();
            $crmNew->setName($crm);
            $this->em->persist($crmNew);
        }
        $this->em->flush();
    }

    private function loadMediaObjectData(): void {
        $folder = '/var/www/html/public/artisans'; // Example: 'uploads/images'

        // Get all files (excluding directories and hidden files)
        $files = array_filter(glob($folder . '/*.jpg'), 'is_file');

        foreach ($files as $file) {
            $media = new MediaObject();
            $media->setFilePath(basename($file));
            $media->setMimeType('mime/jpg');
            $media->setType("file");
            $this->em->persist($media);
        }

        $this->em->flush();
    }

    private function loadArtisanData(): void {

        // Define bounding box for France (approximate)
        $minLat = 5.05471564610935;  // South
        $maxLat = 10.166634308597645;  // North
        $minLng = -5.842123821490614;  // West
        $maxLng = -6.0236533472455145;   // East
        $locations = $this->generateRandomCoordinates(20, $minLat, $maxLat, $minLng, $maxLng);

        $typePieces = [
            "passeport",
            "cni",
            "carte consulaire",
            "extrait de naissance",
            "permis de conduire"
        ];
        $sexe= [
            'F',
            'H'
        ];
        $maritalStatus= [
            'Marié',
            'Veuf(ve)',
            'Divorcé'
        ];
        $this->faker = Factory::create();

        $metiers = $this->em->getRepository(Metiers::class)->findAll();
      //  $crms = $this->em->getRepository(Crm::class)->findAll();
        $entreprises = $this->em->getRepository(Entreprise::class)->findAll();
        $medias = $this->em->getRepository(MediaObject::class)->findAll();
        $communes = $this->em->getRepository(Communes::class)->findAll();
        $villes = $this->em->getRepository(Villes::class)->findAll();
        $pays = $this->em->getRepository(Pays::class)->findAll();
        $nationalites = $this->em->getRepository(Nationalities::class)->findAll();
        $categoryArtisans = $this->em->getRepository(CategoryArtisan::class)->findAll();


        for ($i = 0; $i < self::ARTISAN_COUNT; $i++) {
            $artisan = new Artisan();
            $artisan->setPhoto($this->faker->randomElement($medias));
            $artisan->setNom($this->faker->lastName());
            $artisan->setPrenoms($this->faker->firstName);
            $artisan->setSexe($this->faker->randomElement($sexe));
            $artisan->setVilleNaissance($this->faker->randomElement($villes));
            $artisan->setNationalite($this->faker->randomElement($villes));
            $artisan->setPaysNaissance($this->faker->randomElement($pays));
            $artisan->setEmail($this->faker->email);
            $artisan->setDomicile($this->faker->randomElement($communes));
            $artisan->setEtatCivil($this->faker->randomElement($maritalStatus));

            $artisan->setDateNaissance(new DateTime($this->faker->date('Y-m-d')));
            $artisan->setDrivingLicenseNumber(mt_rand());
            $artisan->setDateNaissance(new DateTime($this->faker->date('Y-m-d')));

            $artisan->setActiviteExercee($this->faker->randomElement($metiers));
            $artisan->setActiviteExerceeLieu($this->faker->city());
            $artisan->setActivitePrincipale($this->faker->randomElement($metiers));
            $artisan->setActiviteSecondaire($this->faker->randomElement($metiers));

            $artisan->setCategoryArtisan($this->faker->randomElement($categoryArtisans));

            $artisan->setNumeroPieceIdentite(mt_rand());
            $artisan->setTypePieceIdentite($this->faker->randomElement($typePieces));
            $artisan->setAutoriteDelivrancePieceIdentite('ONECI');
            $artisan->setDateDelivrancePieceIdentite($this->faker->dateTimeBetween('-10 years', 'now'));

            $artisan->setCnps(mt_rand());
            $artisan->setLatitude($this->faker->latitude());
            $artisan->setLongitude($this->faker->longitude());

            $artisan->setCreatedAt(new \DateTime());
            $artisan->setDateNaissance(new \DateTime($this->faker->date('Y-m-d')));

            $artisan->setFormationApprentissageMetier($this->faker->word);
            $artisan->setFormationApprentissageMetierNiveau(mt_rand(0,3));
            $artisan->setFormationApprentissageMetierDiplome($this->faker->word);

            $artisan->setNationalite($this->faker->randomElement($nationalites));
            $artisan->setNumeroRM(mt_rand());
            $artisan->setPaysNaissance($this->faker->randomElement($pays));

            $entreprise = $this->faker->randomElement($entreprises);
            $artisan->setEntreprise($entreprise);
            $artisan->setCrm($entreprise->getCrm());

            $this->em->persist($artisan);
        }

        $this->em->flush();
    }

    private function loadUsersData(): void {

        $mediaObjects = $this->em->getRepository(MediaObject::class)->findAll();
        $medias = [];
        foreach ($mediaObjects as $mediaObject) {
            $medias[] = $mediaObject;
        }

        $user = new User();
        $user->setEmail("anguidev@gmail.com");
        $user->setEmail("anguidev@gmail.com");
        $user->setUsername("anguidev");
        $user->setPassword($this->hasher->hashPassword($user,"scawfield"));
        $user->setPhoto($this->faker->randomElement($medias));
        $user->setPlainPassword("scawfield");
        $user->setNom("ANGUI");
        $user->setPrenoms("HERMANN");
        $user->setRoles(['ROLE_ADMIN']);
        $this->em->persist($user);

        $user2 = new User();
        $user2->setEmail("superviseur@gmail.com");
        $user2->setSexe("H");
        $user2->setPhoto($this->faker->randomElement($medias));
        $user2->setUsername("superviseur");
        $user2->setPassword($this->hasher->hashPassword($user2,"superviseur"));
        $user2->setPlainPassword("anguidev");
        $user2->setNom("ANGUI");
        $user2->setPrenoms("HERMANN");
        $user2->setRoles(['ROLE_SUPERVISEUR']);
        $this->em->persist($user2);

        $user3 = new User();
        $user3->setEmail("recenseur@gmail.com");
        $user3->setSexe("H");
        $user3->setPhoto($this->faker->randomElement($medias));
        $user3->setUsername("recenseur");
        $user3->setPassword($this->hasher->hashPassword($user3,"recenseur"));
        $user3->setPlainPassword("recenseur");
        $user3->setNom("Agent");
        $user3->setPrenoms("recenseur");
        $user3->setRoles(['ROLE_RECENSEUR']);
        $this->em->persist($user3);

        $user4 = new User();
        $user4->setEmail("agent.cnmci@gmail.com");
        $user4->setSexe("H");
        $user4->setPhoto($this->faker->randomElement($medias));
        $user4->setUsername("agent-cnmci");
        $user4->setPassword($this->hasher->hashPassword($user4,"recenseur"));
        $user4->setPlainPassword("recenseur");
        $user4->setNom("Agent");
        $user4->setPrenoms("CNMCI");
        $user4->setRoles(['ROLE_AGENT_CNMCI']);
        $this->em->persist($user4);

        $roles = [
            "ROLE_ADMIN",
            "ROLE_SUPERVISEUR",
            "ROLE_RECENSEUR",
            "ROLE_SUPERVISEUR",
        ];
        for($i = 0; $i < self::USER_COUNT ; $i++) {
            $userNew = new User();
            $userNew->setEmail("agent.cnmci@gmail.com");
            $userNew->setSexe("H");
            $userNew->setPhoto($this->faker->randomElement($medias));
            $userNew->setUsername("agent-cnmci");
            $userNew->setPassword($this->hasher->hashPassword($userNew,"recenseur"));
            $userNew->setPlainPassword("recenseur");
            $userNew->setNom("Agent");
            $userNew->setPrenoms("CNMCI");
            $role[] = $this->faker->randomElement($roles);
            $userNew->setRoles($role);
            $this->em->persist($user4);
        }

        $this->em->flush();
    }

    private function loadCategoryArtisanData(): void {
        $categories = [
            "MAÎTRE ARTISAN",
            "COMPAGNON",
            "APPRENTI",
            "ENTREPRISE ARTISANALE",
        ];
        foreach ($categories as $category) {
            $categoryNew = new CategoryArtisan();
            $categoryNew->setName($category);
            $this->em->persist($categoryNew);
        }
        $this->em->flush();
    }

    private function loadIdentificationsData(): void {

        $artisanObjects = $this->em->getRepository(Artisan::class)->findAll();
        $artisans = [];
        foreach ($artisanObjects as $artisanObject) {
            $artisans[] = $artisanObject;
        }

        $userObjects = $this->em->getRepository(User::class)->findAll();
        $users = [];
        foreach ($userObjects as $userObject) {
            $users[] = $userObject;
        }


        for ($i = 0; $i < self::ARTISAN_COUNT; $i++){
            $identification = new Identification();
            $identification->setType("DIRECT");
            $identification->setLongitude(null);
            $identification->setLongitude(null);
            $identification->setStatus("PENDING");
            $identification->setArtisan($this->faker->randomElement($artisans));
            $identification->setAgent($this->faker->randomElement($users));
            $this->em->persist($identification);
            $this->em->flush();
        }
    }

    private function loadImmatriculationsData(): void {

        $paymentTypes = [
            "ORANGE",
            "MTN",
            "WAVE",
            "MOOV"
        ];
        $artisans = $this->em->getRepository(Artisan::class)->findAll();
        $identifications = $this->em->getRepository(Artisan::class)->findAll();
        $users = $this->em->getRepository(User::class)->findBy([
            "roles" => ["ROLE_RECENSEUR"],
        ]);

        for ($i = 0; $i < self::ARTISAN_COUNT; $i++){

            $paymentType = $this->faker->randomElement($paymentTypes);
            $artisan = $this->faker->randomElement($artisans);

            $immatriculation = new Immatriculation();
            $immatriculation->setType("DIRECT");
            $immatriculation->setAgent($this->faker->randomElement($users));
            $immatriculation->setIdentification($this->faker->randomElement($identifications));
            $immatriculation->setLongitude(null);
            $immatriculation->setLongitude(null);
            $immatriculation->setStatus("PENDING");
            $immatriculation->setArtisan($artisan);
            $immatriculation->setCode(Uuid::v4()->toRfc4122());
            $immatriculation->setPaymentType($paymentType);
            $this->em->persist($immatriculation);
            $this->em->flush();

            $payment = new Payment();
            $payment->setType("IMMATRICULATION");
            $payment->setStatus("PENDING");
            $payment->setPaymentFor($artisan);
            $payment->setCodePaymentOperateur(mt_rand(150000,2555885));
            $payment->setMontant(12500);
            $payment->setOperateur("WAVE");
            $payment->setReceiptNumber(mt_rand());
            $payment->setTarget("IMMATRICULATION");
            $payment->setUser($this->faker->randomElement($users));
        }
    }

    private function EquipeLoadData(): void {
        $userObjects = $this->em->getRepository(User::class)->findAll();
        $users = [];
        foreach ($userObjects as $userObject) {
            $users[] = $userObject;
        }

        for($i = 0; $i < self::EQUIPE_COUNT ; $i++){
            $equipeNew = new EquipeAgent();
            $equipeNew->addMembre($this->faker->randomElement($users));
            $equipeNew->setSuperviseur($this->faker->randomElement($users));
            $this->em->persist($equipeNew);
            $this->em->flush();
        }
    }

    // Generate random coordinates
    function generateRandomCoordinates($count, $minLat, $maxLat, $minLng, $maxLng) {
        $coordinates = [];
        for ($i = 0; $i < $count; $i++) {
            $lat = mt_rand($minLat * 1000000, $maxLat * 1000000) / 1000000;
            $lng = mt_rand($minLng * 1000000, $maxLng * 1000000) / 1000000;
            $coordinates[] = ['lat' => $lat, 'lng' => $lng];
        }
        return $coordinates;
    }

}
