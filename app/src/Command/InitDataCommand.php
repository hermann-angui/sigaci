<?php

namespace App\Command;

use App\Entity\Artisan;
use App\Entity\BrancheMetier;
use App\Entity\CategoryArtisan;
use App\Entity\Communes;
use App\Entity\CorpsMetiers;
use App\Entity\Crm;
use App\Entity\Department;
use App\Entity\EquipeAgent;
use App\Entity\Entreprise;
use App\Entity\Identification;
use App\Entity\Immatriculation;
use App\Entity\MediaObject;
use App\Entity\Metiers;
use App\Entity\Nationalities;
use App\Entity\Payment;
use App\Entity\Pays;
use App\Entity\SousPrefecture;
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

    const FILE_PREFIX = "siga_db_table_";
    const PATH = "/var/www/html/var/media/initdata/";

    public function __construct(private readonly EntityManagerInterface  $em, private readonly UserPasswordHasherInterface $hasher,) {
        parent::__construct();
    }

    protected function configure(): void {
        $this
            ->addOption('mediaobjects', null, InputOption::VALUE_REQUIRED, "mediaobjects", 0)
            ->addOption('departements', null, InputOption::VALUE_OPTIONAL, "departements", 0)
            ->addOption('metiers', null, InputOption::VALUE_OPTIONAL, "metiers", 0)
            ->addOption('pays', null, InputOption::VALUE_OPTIONAL, "pays", 0)
            ->addOption('villes', null, InputOption::VALUE_OPTIONAL, "villes", 0)
            ->addOption('communes', null, InputOption::VALUE_OPTIONAL, "communes", 0)
            ->addOption('sous_prefectures', null, InputOption::VALUE_OPTIONAL, "sous_prefectures", 0)
            ->addOption('corps_metiers', null, InputOption::VALUE_OPTIONAL, "corps_metiers", 0)
            ->addOption('crms', null, InputOption::VALUE_OPTIONAL, "crms", 0)
            ->addOption('branche_metiers', null, InputOption::VALUE_OPTIONAL, "branche_metiers", 0)
            ->addOption('equipes', null, InputOption::VALUE_OPTIONAL, "equipes", 0)
            ->addOption('departements', null, InputOption::VALUE_OPTIONAL, "departements", 0)
            ->addOption('users', null, InputOption::VALUE_REQUIRED, "users", 0)
            ->addOption('artisans', null, InputOption::VALUE_REQUIRED, "artisans", 0)
            ->addOption('category_artisans', null, InputOption::VALUE_OPTIONAL, "category_artisans", 0)
            ->addOption('immatriculations', null, InputOption::VALUE_OPTIONAL, "immatriculations", 0)
            ->addOption('identifications', null, InputOption::VALUE_OPTIONAL, "identifications", 0)
        ;
    }


    // php bin/console InitDataCommand  --pays=1 --communes=1 --sous_prefectures=1 --villes=1 --departements=1 --crms=1 --branche_metiers=1 --corps_metiers=1 --metiers=1 --mediaobjects=1
    protected function execute(InputInterface $input, OutputInterface $output): int {
        $io = new SymfonyStyle($input, $output);
        $this->faker = Factory::create();

        if ($input->getOption('pays')) {
            $this->loadPaysData();
        }

        if ($input->getOption('communes')) {
            $this->loadCommunesData();
        }

        if($input->getOption('sous_prefectures')){
            $this->loadSousPrefecturesData();
        }

        if ($input->getOption('villes')) {
            $this->loadVillesData();
        }

        if ($input->getOption('departements')) {
            $this->loadDepartementsData();
        }

        if ($input->getOption('branche_metiers')) {
            $this->loadBrancheMetiersData();
        }

        if ($input->getOption('corps_metiers')) {
            $this->loadCorpsMetiersData();
        }

        if ($input->getOption('metiers')) {
            $this->loadMetiersData();
        }

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

    private function  loadDepartementsData(): void {
        $fp = fopen(self::PATH . self::FILE_PREFIX . "departments.csv", 'r');
        $header = fgetcsv($fp, 1000, ';');
        while($row = fgetcsv($fp, 2000, ';')) {
            $data = array_combine($header, $row);
            $department = new Department();
            $department->setCode($data['code']);
            $crm = $this->em->getRepository(Crm::class)->find($data['crm_id']);
            $department->setCrm($crm);
            $department->setName(trim($data['name']));
            $department->setId((int)$data['id']);
            $this->em->persist($department);
        }
        $this->em->flush();
    }

    private function loadSousPrefecturesData(): void {
        $fp = fopen(self::PATH . self::FILE_PREFIX . "sous_prefecture.csv", 'r');
        $header = fgetcsv($fp, 1000, ';');
        $count = 1;
        while($row = fgetcsv($fp, 1000, ';')){
            $data = array_combine($header, $row);
            if(!empty($data['name'])) {
                $names = explode("," , $data['name']);
                foreach ($names as $name){
                    $sousPrefecture = new SousPrefecture();
                    $sousPrefecture->setCode("SP_" . $count++);
                    $department = $this->em->getRepository(Department::class)->find($data['departement_id']);
                    if($department) $sousPrefecture->setDepartment($department);
                    $sousPrefecture->setName($name);
                    $this->em->persist($sousPrefecture);
                }
            }
        }
        $this->em->flush();
    }

    private function loadCrmsData(): void {
        $fp = fopen(self::PATH . self::FILE_PREFIX . "crms.csv", 'r');
        $header = fgetcsv($fp, 1000, ';');
        while($row = fgetcsv($fp, 2000, ';')){
            $data = array_combine($header, $row);
            $crm = new Crm();
            $crm->setCode($data['code']);
            $crm->setName(trim($data['name']));
            $crm->setAbbr($data["abbr"]);
            $crm->setId((int)$data['id']);
            $this->em->persist($crm);
        }
        $this->em->flush();
    }

    private function  loadVillesData(): void {
        $fp = fopen(self::PATH . self::FILE_PREFIX . "villes.csv", 'r');
        $header = fgetcsv($fp, 1000, ';');
        while($row = fgetcsv($fp, 1000, ';')){
            $data = array_combine($header, $row);
            $ville = new Villes();
            $ville->setCode($data['code']);
            $ville->setName(trim($data['name']));
            $ville->setId((int)$data['id']);
            $this->em->persist($ville);
        }
        $this->em->flush();

    }

    private function  loadPaysData(): void {
        $fp = fopen(self::PATH . self::FILE_PREFIX . "pays.csv", 'r');
        $header = fgetcsv($fp, 1000, ';');
        while($row = fgetcsv($fp, 2000, ';')){
            $data = array_combine($header, $row);
            $pays = new Pays();
            $pays->setCode($data['code']);
            $pays->setName(trim($data['name']));
            $pays->setId((int)$data['id']);
            $this->em->persist($pays);
        }
        $this->em->flush();
    }

    private function  loadCommunesData(): void {
        $fp = fopen(self::PATH . self::FILE_PREFIX . "communes.csv", 'r');
        $header = fgetcsv($fp, 1000, ';');
        while($row = fgetcsv($fp, 2000, ';')){
            $data = array_combine($header, $row);
            $commune = new Communes();
            $commune->setCode($data['code']);
            $commune->setName(trim($data['name']));
            $commune->setId((int)$data['id']);
            $this->em->persist($commune);
        }
        $this->em->flush();
    }

    private function  loadBrancheMetiersData(): void {
        $fp = fopen(self::PATH . self::FILE_PREFIX . "branche_metiers.csv", 'r');
        $header = fgetcsv($fp, 1000, ';');
        while($row = fgetcsv($fp, 2000, ';')){
            $data = array_combine($header, $row);
            $brancheMetier = new BrancheMetier();
            $brancheMetier->setCode($data['code']);
            $brancheMetier->setName(trim($data['name']));
            $brancheMetier->setId((int)$data['id']);
            $this->em->persist($brancheMetier);
        }
        $this->em->flush();
    }

    private function  loadCorpsMetiersData(): void {
        $fp = fopen(self::PATH . self::FILE_PREFIX . "corps_metiers.csv", 'r');
        $header = fgetcsv($fp, 1000, ';');
        while($row = fgetcsv($fp, 2000, ';')){
            $data = array_combine($header, $row);
            $corpsMetier = new CorpsMetiers();
            $corpsMetier->setCode($data['code']);

            $brancheMetier = $this->em->getRepository(BrancheMetier::class)->find($data['branche_metier_id']);
            $corpsMetier->setBrancheMetier($brancheMetier);
            $corpsMetier->setName(trim($data['name']));
            $corpsMetier->setId((int)$data['id']);
            $this->em->persist($corpsMetier);
        }
        $this->em->flush();
    }

    private function  loadMetiersData(): void {
        $fp = fopen(self::PATH . self::FILE_PREFIX . "metiers.csv", 'r');
        $header = fgetcsv($fp, 1000, ';');
        while($row = fgetcsv($fp, 2000, ';')){
            $data = array_combine($header, $row);
            $metier = new Metiers();
            $metier->setCode($data['code']);
            $corpsMetier = $this->em->getRepository(CorpsMetiers::class)->find($data['corps_metiers_id']);
            $metier->setCorpsMetiers($corpsMetier);
            $metier->setName(trim($data['name']));
            $metier->setId((int)$data['id']);
            $this->em->persist($metier);
        }
        $this->em->flush();
    }

    private function loadMediaObjectData(): void {
        $folder = '/var/www/html/public/media'; // Example: 'uploads/images'

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

    private function loadCategoryArtisanData(): void {
        $fp = fopen(self::PATH . self::FILE_PREFIX . "category_artisans.csv", 'r');
        $header = fgetcsv($fp, 1000, ';');
        while($row = fgetcsv($fp, 2000, ';')){
            $data = array_combine($header, $row);
            $categoryArtisan = new CategoryArtisan();
            $categoryArtisan->setCode($data['code']);
            $categoryArtisan->setName(trim($data['name']));
            $categoryArtisan->setId((int)$data['id']);
            $this->em->persist($categoryArtisan);
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
        $crms = $this->em->getRepository(Crm::class)->findAll();
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
           // $artisan->setCategoryArtisan();
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

            $artisan->setEntreprise( $this->faker->randomElement($entreprises));
            $artisan->setCrm($this->faker->randomElement($crms));

            $this->em->persist($artisan);
        }

        $this->em->flush();
    }

    private function loadUsersData(): void {

        $medias = $this->em->getRepository(MediaObject::class)->findAll();
        $user = new User();
        $user->setEmail("anguidev@gmail.com");
        $user->setUsername("anguidev");
        $user->setPassword($this->hasher->hashPassword($user,"scawfield"));
        $user->setPhoto($this->faker->randomElement($medias));
        $user->setPlainPassword("scawfield");
        $user->setNom("ANGUI");
        $user->setPrenoms("HERMANN");
        $user->setRoles(['ROLE_ADMIN']);
        $this->em->persist($user);

        $user6 = new User();
        $user6->setEmail("mbambi4@gmail.com");
        $user6->setUsername("mbambi");
        $user6->setPassword($this->hasher->hashPassword($user6,"Lazarus01!"));
        $user6->setPhoto($this->faker->randomElement($medias));
        $user6->setPlainPassword("Lazarus01!");
        $user6->setNom("Mbambi");
        $user6->setPrenoms("junior");
        $user6->setRoles(['ROLE_ADMIN']);
        $this->em->persist($user6);

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

        $user5 = new User();
        $user5->setEmail("dossmeno@bmi.ci");
        $user5->setSexe("H");
        $user5->setPhoto($this->faker->randomElement($medias));
        $user5->setUsername("bmi");
        $user5->setPassword($this->hasher->hashPassword($user5,"bmi"));
        $user5->setPlainPassword("recenseur");
        $user5->setNom("dosso");
        $user5->setPrenoms("dosso");
        $user5->setRoles(['ROLE_AGENT_BMI']);
        $this->em->persist($user5);

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

    private function loadIdentificationsData(): void {
        $artisans = $this->em->getRepository(Artisan::class)->findAll();
        $users = $this->em->getRepository(User::class)->findAll();

        for ($i = 0; $i < self::ARTISAN_COUNT; $i++){
            $identification = new Identification();
            $identification->setType("DIRECT");
            $identification->setLongitude(null);
            $identification->setLatitude(null);
            $identification->setReference("PENDING");
            $identification->setNumeroReferenceExterne(Uuid::v4()->toString());
            $identification->setAgent($this->faker->randomElement($users));
            $identification->setStatus("PENDING");
            $identification->setSource("BMI");
            $identification->setCode($this->faker->randomElement($artisans));
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
        // $identifications = $this->em->getRepository(Artisan::class)->findAll();
        $users = $this->em->getRepository(User::class)->findBy([
            "roles" => ["ROLE_RECENSEUR"],
        ]);

        for ($i = 0; $i < self::ARTISAN_COUNT; $i++){

            $paymentType = $this->faker->randomElement($paymentTypes);
            $artisan = $this->faker->randomElement($artisans);

            $immatriculation = new Immatriculation();
            $immatriculation->setType("EA");
            $immatriculation->setAgent($this->faker->randomElement($users));
            $immatriculation->setLongitude(null);
            $immatriculation->setLongitude(null);
            $immatriculation->setStatus("PENDING");
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
            $payment->setPaymentFor();
            $payment->setUser($this->faker->randomElement($users));
        }
    }

    private function EquipeLoadData(): void {
        $userObjects = $this->em->getRepository(User::class)->findAll();
        for($i = 0; $i < self::EQUIPE_COUNT ; $i++){
            $equipeNew = new EquipeAgent();
            $equipeNew->addMembre($this->faker->randomElement($userObjects));
            $equipeNew->setSuperviseur($this->faker->randomElement($userObjects));
            $this->em->persist($equipeNew);
            $this->em->flush();
        }
    }

    // Generate random coordinates
    function generateRandomCoordinates($count, $minLat, $maxLat, $minLng, $maxLng): array
    {
        $coordinates = [];
        for ($i = 0; $i < $count; $i++) {
            $lat = mt_rand($minLat * 1000000, $maxLat * 1000000) / 1000000;
            $lng = mt_rand($minLng * 1000000, $maxLng * 1000000) / 1000000;
            $coordinates[] = ['lat' => $lat, 'lng' => $lng];
        }
        return $coordinates;
    }

}
