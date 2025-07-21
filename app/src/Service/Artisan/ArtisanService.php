<?php

namespace App\Service\Artisan;

use App\Entity\Artisan;
use App\Helper\ActivityLogger;
use App\Helper\ArtisanAssetHelper;
use App\Helper\CsvReaderHelper;
use App\Helper\FileHelper;
use App\Helper\PasswordHelper;
use App\Helper\PdfGenerator;
use App\Repository\ArtisanRepository;
use App\Repository\ChildRepository;
use App\Service\AbstractService;
use App\Service\ConfigurationService\ConfigurationService;
use DateTime;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use SplFileInfo;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Uid\Uuid;

/**
 *
 */
class ArtisanService extends AbstractService
{
    /**
     * @param ContainerInterface $container
     * @param ArtisanCardGeneratorService $artisanCardGeneratorService
     * @param ArtisanAssetHelper $artisanAssetHelper
     * @param ChildRepository $childRepository
     * @param UserPasswordHasherInterface $userPasswordHasher
     * @param PdfGenerator $pdfGenerator
     * @param ConfigurationService $configurationService
     * @param ActivityLogger $activityLogger
     * @param CsvReaderHelper $csvReaderHelper
     */
    public function __construct(
        private ContainerInterface             $container,
        private ArtisanCardGeneratorService    $artisanCardGeneratorService,
        private ArtisanAssetHelper             $artisanAssetHelper,
        private ArtisanRepository              $artisanRepository,
        private ChildRepository                $childRepository,
        private UserPasswordHasherInterface    $userPasswordHasher,
        private PdfGenerator                   $pdfGenerator,
        private ActivityLogger                 $activityLogger,
        private CsvReaderHelper                $csvReaderHelper)
    {
        parent::__construct($artisanRepository);
    }

    /**
     * @param Artisan $artisan
     * @return void
     * @throws \Exception
     */
    public function createArtisan(Artisan $artisan, array $images): ?Artisan
    {
        try {
            date_default_timezone_set("Africa/Abidjan");

            $artisan->setRoles(['ROLE_USER']);
            $date = new DateTime('now');

            $artisan->setSubscriptionDate($date);
            if (!$artisan->getReference()) {
                $artisan->setReference(
                    str_replace("-", "", substr(Uuid::v4()->toRfc4122(), 0, 18))
                );
            }

            $expiredDate = $date->format('Y-12-31');
            $artisan->setSubscriptionExpireDate(new \DateTime($expiredDate));

            $artisan->setPassword($this->userPasswordHasher->hashPassword($artisan, PasswordHelper::generate()));

            if(!empty($images)) $this->storeArtisanImages($artisan, $images);

            $artisan->setCountry($artisan->getBirthCountry());

            $artisan->setIsCardProduced(false);
            $artisan->setIsRegistreProduced(false);

            $this->artisanRepository->add($artisan, true);
            return $artisan;

        }catch(\Exception $e){
            return null;
        }
    }

    /**
     * @param Artisan $artisan
     * @return void
     * @throws \Exception
     */
    public function updateArtisan(Artisan $artisan, array $images): ?Artisan
    {
        try {
            date_default_timezone_set("Africa/Abidjan");
            if (!$artisan->getReference()) {
                $artisan->setReference(
                    str_replace("-", "", substr(Uuid::v4()->toRfc4122(), 0, 18))
                );
            }

            $artisan->setCountry($artisan->getBirthCountry());
            if(!empty($images)) $this->storeArtisanImages($artisan, $images);

            if($children = $artisan->getChildren()){
                foreach($children as $child){
                    $this->childRepository->add($child, true);
                }
            }

            $this->persist($artisan);
            return $artisan;

        }catch(\Exception $e){
            return $artisan;
        }
    }

    /**
     * @param Artisan|null $artisan
     * @return Artisan|null
     */
    public function generateSingleCnmciCard(?Artisan $artisan): ?Artisan
    {
        date_default_timezone_set("Africa/Abidjan");
        if ($artisan) {
            $artisan = $this->artisanCardGeneratorService->generateCardCnmci($artisan);
            $this->artisanRepository->add($artisan, true);
            return $artisan;
        }
        return null;
    }

    public function renewCard(?Artisan $artisan): ?Artisan
    {
        date_default_timezone_set("Africa/Abidjan");
        if ($artisan) {
            $now = new DateTime('now');
            $date = new DateTime('now');
            $artisan->setSubscriptionDate($now);
            $artisan->setSubscriptionExpireDate($date->modify('+1 year'));
            $this->artisanRepository->add($artisan, true);
            $this->generateSingleCnmciCard($artisan);
            return $artisan;
        }
        return null;
    }

    /**
     * @param array $artisans
     * @return string|null
     */
    public function archiveArtisanCards(array $artisans): ?string
    {
        date_default_timezone_set("Africa/Abidjan");
        set_time_limit(0);
        $zipArchive = new \ZipArchive();
        $zipFile = $this->container->getParameter('kernel.project_dir') . '/public/artisans/tmp_artisans.zip';
        if(file_exists($zipFile)) unlink($zipFile);
        if($zipArchive->open($zipFile, \ZipArchive::CREATE) === true)
        {
            /**@var Artisan $artisan **/
            foreach($artisans as $artisan)
            {
                $file = $this->artisanAssetHelper->getArtisanDir($artisan) . $artisan->getPhoto();
                if(is_file($file)) {
                    $zipArchive->addFile($file, $artisan->getReference() . '_photo.png');
                }
                $file = $this->artisanAssetHelper->getArtisanDir($artisan) . $artisan->getCnmciCardFrontImage();
                if(is_file($file)) {
                    $zipArchive->addFile($file, 'carte_cnmci_recto.png');
                }
                $file = $this->artisanAssetHelper->getArtisanDir($artisan) . $artisan->getCnmciCardBackImage();
                if(is_file($file)) {
                    $zipArchive->addFile($file, 'carte_cnmci_verso.png');
                }

            }
            $zipArchive->close();
            return $zipFile;
        }
        return null;
    }

    /**
     * @return void
     */
    public function getArtisanCardsList(){
        $zipFile = $this->container->getParameter('kernel.project_dir') . '/public/artisans/tmp/artisans.zip';
         if(!file_exists($zipFile)){
             $this->generateMultipleArtisanCards();
         }
    }

    /**
     * @return string
     */
    public function generateSampleCsvFile()
    {
        date_default_timezone_set("Africa/Abidjan");
        $sampleRealPath = $this->container->getParameter('kernel.project_dir') . "/public/assets/files/sample.csv";
        $columns = [
            "NOM",
            "PRENOMS",
            "PHOTO",
            "SEXE",
            "EMAIL",
            "WHATSAPP",
            "COMPAGNIE",
            "DATE_NAISSANCE",
            "LIEU_NAISSANCE",
            "NUMERO_PERMIS",
            "NUMERO_PIECE",
            "TYPE_PIECE",
            "PAYS",
            "VILLE",
            "COMMUNE",
            "MOBILE",
            "FIXE",
            "QUARTIER",
            "DATE_SOUSCRIPTION",
            "DATE_EXPIRATION_SOUSCRIPTION",
            "PHOTO_PIECE_RECTO",
            "PHOTO_PIECE_VERSO",
            "PHOTO_PERMIS_RECTO",
            "PHOTO_PERMIS_VERSO"
        ];
        $fp = fopen($sampleRealPath, "w+");
        fputcsv($fp, $columns);
        fputcsv($fp, []);
        fclose($fp);
        return $sampleRealPath;
    }

    /**
     * @return void
     */
    public function createArtisanFromFile(): void
    {
        set_time_limit(3600);
        $finder = new Finder();
        $uploadDir = $this->container->getParameter('kernel.project_dir') . '/public/uploads/';
        $csvFiles = $finder->in($uploadDir)->name(['*.csv','*.jpg', '*.jpeg','*.png','*.gif']);
        $fs = new Filesystem();
        // remove file after import
        foreach($csvFiles as $file) {
            $rows =  $this->csvReaderHelper->read($file);
            foreach ($rows as $row){
                try{
                    date_default_timezone_set("Africa/Abidjan");
                    $date = new DateTime('now');

                    $sexCode = "SY1";
                    if (!empty($row["SEXE"])) {
                        if ($row["SEXE"] === "M") $sexCode = "SY1";
                        if ($row["SEXE"] === "F") $sexCode = "SY2";
                    } else {
                        throw new \Exception("Skip"); // Unable to determine sex so skip because it is not possible to generate
                    }

                    $artisan = new Artisan();

                    $artisan->setRoles(['ROLE_USER']);
                    if (isset($row["SEXE"])) $artisan->setSex(mb_strtoupper($row["SEXE"], 'UTF-8'));
                    if (isset($row["EMAIL"])) $artisan->setEmail(trim($row["EMAIL"]));
                    if (isset($row["NOM"])) $artisan->setLastName(mb_strtoupper(trim($row["NOM"]), 'UTF-8'));
                    if (isset($row["COMPAGNIE"])) $artisan->setCompany($row["COMPAGNIE"]);
                    if (isset($row["NATIONALITE"])) $artisan->setLastName(mb_strtoupper(trim($row["NATIONALITE"]), 'UTF-8'));
                    if (isset($row["PRENOMS"])) $artisan->setFirstName(mb_strtoupper(trim($row["PRENOMS"]), 'UTF-8'));
                    if (isset($row["DATE_NAISSANCE"])) $artisan->setDateOfBirth(new DateTime($row["DATE_NAISSANCE"]));
                    if (isset($row["LIEU_NAISSANCE"])) $artisan->setBirthCity(mb_strtoupper(trim($row["LIEU_NAISSANCE"])));
                    if (isset($row["NUMERO_PERMIS"])) $artisan->setDrivingLicenseNumber($row["NUMERO_PERMIS"]);
                    if (isset($row["NUMERO_PIECE"])) $artisan->setIdNumber($row["NUMERO_PIECE"]);
                    if (isset($row["TYPE_PIECE"])) $artisan->setIdType(mb_strtoupper(trim($row["TYPE_PIECE"])));
                    if (isset($row["PAYS"])) $artisan->setCountry(mb_strtoupper(trim($row["PAYS"])));
                    if (isset($row["VILLE"])) $artisan->setCity(mb_strtoupper($row["VILLE"], 'UTF-8'));
                    if (isset($row["COMMUNE"])) $artisan->setCommune(mb_strtoupper($row["COMMUNE"], 'UTF-8'));
                    if (isset($row["MOBILE"])) $artisan->setMobile($row["MOBILE"]);
                    if (isset($row["FIXE"])) $artisan->setPhone($row["FIXE"]);

                    $artisan->setPassword($this->userPasswordHasher->hashPassword($artisan, PasswordHelper::generate()));

                    if (array_key_exists("DATE_SOUSCRIPTION", $row)) {
                        if (empty($row["DATE_SOUSCRIPTION"])) $artisan->setSubscriptionDate($date);
                        else $artisan->setSubscriptionDate(new DateTime($row["DATE_SOUSCRIPTION"]));
                    }

                    if (array_key_exists("DATE_EXPIRATION_SOUSCRIPTION", $row)) {
                        $expiredDate = new DateTime($row["DATE_SOUSCRIPTION"]);
                        //   $expiredDate = $expiredDate->add(new \DateInterval("P1Y"));
                        $expiredDate = $expiredDate->format('Y-12-31');
                        if (!empty($row["DATE_EXPIRATION_SOUSCRIPTION"])) $artisan->setSubscriptionExpireDate(new DateTime($row["DATE_EXPIRATION_SOUSCRIPTION"]));
                        else $artisan->setSubscriptionExpireDate(new DateTime($expiredDate));
                    }

                    $this->artisanRepository->add($artisan, true);

                    $exist = null;
                    if (!$exist) {
                        $this->storeAsset($row["PHOTO"], $uploadDir, $artisan);
                        $this->storeAsset($row["PHOTO_PIECE_RECTO"], $uploadDir, $artisan);
                        $this->storeAsset($row["PHOTO_PIECE_VERSO"], $uploadDir, $artisan);
                        $this->storeAsset($row["PHOTO_PERMIS_RECTO"], $uploadDir, $artisan);
                        $this->storeAsset($row["PHOTO_PERMIS_VERSO"], $uploadDir, $artisan);
                        $this->artisanRepository->add($artisan, true);
                    } else {
                        $this->artisanRepository->remove($artisan, true);
                    }
                }
                catch(\Exception $e){
                    continue;
                }
            }
        }
        $fs->remove($csvFiles);
    }

    /**
     * @param Artisan $artisan
     * @return void
     */
    public function storeArtisanImages(Artisan $artisan, $images): Artisan
    {
        if(empty($images)) return $artisan;

        if (isset($images['photo'])) {
            $fileName = $this->artisanAssetHelper->uploadAsset($images['photo'], $artisan->getReference());
            $existingFile = $artisan->getPhoto() ? $this->getArtisanDir($artisan) . $artisan->getPhoto(): null;
            FileHelper::deleteExistingFile($existingFile);
            if ($fileName) $artisan->setPhoto($fileName->getFilename());
        }

        if (isset($images['photoPieceFront'])) {
            $fileName = $this->artisanAssetHelper->uploadAsset($images['photoPieceFront'], $artisan->getReference());
            $existingFile = $artisan->getPhotoPieceFront() ? $this->getArtisanDir($artisan) . $artisan->getPhotoPieceFront(): null;
            if(file_exists($existingFile)) unlink($existingFile);
            if ($fileName) $artisan->setPhotoPieceFront($fileName->getFilename());
        }

        if (isset($images['photoPieceBack'])) {
            $fileName = $this->artisanAssetHelper->uploadAsset($images['photoPieceBack'], $artisan->getReference());
            $existingFile = $artisan->getPhotoPieceBack() ? $this->getArtisanDir($artisan) . $artisan->getPhotoPermisFront(): null;
            if(file_exists($existingFile)) unlink($existingFile);
            if ($fileName) $artisan->setPhotoPieceBack($fileName->getFilename());
        }

        if (isset($images['photoPermisFront'])) {
            $fileName = $this->artisanAssetHelper->uploadAsset($images['photoPermisFront'], $artisan->getReference());
            $existingFile = $artisan->getPhotoPermisFront() ? $this->getArtisanDir($artisan) . $artisan->getPhotoPermisFront(): null;
            if(file_exists($existingFile)) unlink($existingFile);
            if ($fileName) $artisan->setPhotoPermisFront($fileName->getFilename());
        }

        if (isset($images['photoPermisBack'])) {
            $fileName = $this->artisanAssetHelper->uploadAsset($images['photoPermisBack'], $artisan->getReference());
            $existingFile = $artisan->getPhotoPermisBack() ? $this->getArtisanDir($artisan) . $artisan->getPhotoPermisBack(): null;
            if(file_exists($existingFile)) unlink($existingFile);
            if ($fileName) $artisan->setPhotoPermisBack($fileName->getFilename());
        }

        if (isset($images['paymentReceiptCnmciPdf'])) {
            $fileName = $this->artisanAssetHelper->uploadAsset($images['paymentReceiptCnmciPdf'], $artisan->getReference());
            if ($fileName) {
                $existingFile = $artisan->getPaymentReceiptCnmciPdf() ? $this->getArtisanDir($artisan) . $artisan->getPaymentReceiptCnmciPdf(): null;
                if(file_exists($existingFile)) unlink($existingFile);
                $artisan->setPaymentReceiptCnmciPdf($fileName->getFilename());
            }
        }

        if (isset($images['mobileMoneyReceiptImage'])) {
            $fileName = $this->artisanAssetHelper->uploadAsset($images['mobileMoneyReceiptImage'], $artisan->getReference());
            if ($fileName) {
                $existingFile = $artisan->getMobileMoneyReceiptImage() ? $this->getArtisanDir($artisan) . $artisan->getMobileMoneyReceiptImage(): null;
                if(file_exists($existingFile)) unlink($existingFile);
                $artisan->setMobileMoneyReceiptImage($fileName->getFilename());
            }
        }

        return $artisan;
    }

    /**
     * @param $row
     * @param string $uploadDir
     * @param Artisan $artisan
     * @return void
     */
    public function storeAsset($row, string $uploadDir, Artisan $artisan): void
    {
        if (isset($row) && !empty($row)) {
            $photo = new File($uploadDir . $row, false);
            if (file_exists($photo->getPathname())) {
                $fileName = $this->artisanAssetHelper->uploadAsset($photo, $artisan->getReference());
                if ($fileName) $artisan->setPhoto($fileName);
            }
        }
    }

    /**
     * @param Artisan|null $payment
     * @return PdfResponse
     */
    public function downloadFormulaireCNMCIPdf(?Artisan $artisan){
        set_time_limit(0);
        $file = $this->artisanAssetHelper->getArtisanDir($artisan) .  $artisan->getFormulaireCnmciPdf();
        if($artisan->getFormulaireCnmciPdf() && is_file($file)) $content = file_get_contents($file);
        else $content = $this->generateFormulaireCNMCIPdf($artisan, "pdf/formulaire_cnmci.html.twig");
        return new PdfResponse($content, 'fiche_cnmci.pdf');
    }

    /**
     * @param Artisan|null $artisan
     * @param string $viewTemplate
     * @return string|null
     */
    public function generateFormulaireCNMCIPdf(?Artisan $artisan, string $viewTemplate): ?string
    {
        try {
            $content = $this->pdfGenerator->generatePdf($viewTemplate, ['artisan' => $artisan]);
            $file = $this->artisanAssetHelper->getArtisanDir($artisan) . time() . uniqid() . ".pdf";
            $artisan->setFormulaireCnmciPdf(basename($file));
            $this->persist($artisan);
            file_put_contents($file, $content);
            return $content ?? null;
        }catch(\Exception $e){
            return null;
        }
    }

    /**
     * @return void
     */
    public function generateAllPhotoThumbnails(){
        $artisans = $this->artisanRepository->findAll();
        foreach($artisans as $artisan){
            FileHelper::deleteExistingFile($this->artisanAssetHelper->getArtisanDir($artisan) . $artisan->getPhoto());
            $this->artisanAssetHelper->createThumbnail($artisan->getPhoto(),  $artisan->getReference(), 128, 128);
        }
    }

    /**
     * @param array $artisans
     * @param string $file
     * @return string|null
     */
    public function archiveAllArtisanDocuments(array $artisans, string $file): ?string
    {
        $zipArchive = new \ZipArchive();

        $zipFile = $this->container->getParameter('kernel.project_dir') . '/public/cnmci/download.zip';;
        if(file_exists($zipFile)) \unlink($zipFile);

        if($zipArchive->open($zipFile, \ZipArchive::CREATE)) {

            if(file_exists($file)) $zipArchive->addFile($file, 'inscrits.xls');

            /** @var Artisan $artisan **/
            foreach($artisans as $artisan) {
                $dir = $this->artisanAssetHelper->getArtisanDir($artisan);
                $outputFile = $artisan->getReference() . '_'  . $artisan->getLastName() . ' ' . $artisan->getFirstName() . '.' ;
                if(is_file( $dir . $artisan->getPhoto())) {
                    $info = new SplFileInfo($dir . $artisan->getPhoto());
                    $zipArchive->addFile($dir. $artisan->getPhoto(), $outputFile . $info->getExtension());
                }

                if(is_file($dir . $artisan->getFormulaireCnmciPdf())) {
                    $info = new SplFileInfo($dir . $artisan->getFormulaireCnmciPdf());
                    $zipArchive->addFile($dir . $artisan->getFormulaireCnmciPdf(), $outputFile . $info->getExtension());
                }
                if(is_file($dir . $artisan->getPhotoPermisBack())) {
                    $info = new SplFileInfo($dir . $artisan->getPhotoPermisBack());
                    $zipArchive->addFile($dir . $artisan->getPhotoPermisBack(), $outputFile . $info->getExtension());
                    unset($info);
                }
                if(is_file($dir . $artisan->getPhotoPermisFront())) {
                    $info = new SplFileInfo($dir . $artisan->getPhotoPermisFront());
                    $zipArchive->addFile($dir . $artisan->getPhotoPermisFront(), $outputFile . $info->getExtension());
                    unset($info);
                }
                if(is_file($dir . $artisan->getPhotoPieceBack())) {
                    $info = new SplFileInfo($dir . $artisan->getPhotoPieceBack());
                    $zipArchive->addFile($dir . $artisan->getPhotoPieceBack(), $outputFile . $info->getExtension());
                    unset($info);
                }
                if(is_file($dir . $artisan->getPaymentReceiptCnmciPdf())) {
                    $info = new SplFileInfo($dir . $artisan->getPaymentReceiptCnmciPdf());
                    $zipArchive->addFile($dir . $artisan->getPaymentReceiptCnmciPdf(), $outputFile . $info->getExtension());
                    unset($info);
                }
                if(is_file($dir . $artisan->getMobileMoneyReceiptImage())) {
                    $info = new SplFileInfo($dir . $artisan->getMobileMoneyReceiptImage());
                    $zipArchive->addFile($dir . $artisan->getMobileMoneyReceiptImage(), $outputFile . $info->getExtension());
                    unset($info);
                }
            }
            $zipArchive->close();
            return $zipFile;
        }
        return null;
    }

    /**
     * @param Artisan $artisan
     * @param string $file
     * @return string|null
     */
    public function archiveArtisanDocuments(Artisan $artisan): ?string
    {

        $zipArchive = new \ZipArchive();

        $zipFile = $this->container->getParameter('kernel.project_dir') . '/public/cnmci/zip-artisan.zip';
        if(file_exists($zipFile)) \unlink($zipFile);

        if($zipArchive->open($zipFile, \ZipArchive::CREATE)) {

                $dir = $this->artisanAssetHelper->getArtisanDir($artisan);
                $outputFile =  $artisan->getLastName() . ' ' . $artisan->getFirstName()  ;

                if($artisan->getPhoto()) $this->addToArchive($dir . $artisan->getPhoto(), $zipArchive, $outputFile. "_photo.");
                if($artisan->getFormulaireCnmciPdf()) $this->addToArchive($dir . $artisan->getFormulaireCnmciPdf(), $zipArchive, $outputFile. "_fiche.");
                if($artisan->getPhotoPermisFront()) $this->addToArchive($dir . $artisan->getPhotoPermisFront(), $zipArchive, $outputFile. "_permis_recto.");
                if($artisan->getPhotoPermisBack()) $this->addToArchive($dir . $artisan->getPhotoPermisBack(), $zipArchive, $outputFile. "_permis_verso.");
                if($artisan->getPhotoPieceFront()) $this->addToArchive($dir . $artisan->getPhotoPieceFront(), $zipArchive, $outputFile. "__piece_recto.");
                if($artisan->getPhotoPieceBack()) $this->addToArchive($dir . $artisan->getPhotoPieceBack(), $zipArchive, $outputFile. "__piece_verso.");
                if($artisan->getMobileMoneyReceiptImage()) $this->addToArchive($dir . $artisan->getMobileMoneyReceiptImage(), $zipArchive, $outputFile. "_photo.");

                $zipArchive->close();
                return $zipFile;
        }
        return null;
    }

    /**
     * @param string $file
     * @return string|null
     */
    public function archiveMatriceEncaissement(string $file): ?string
    {
        $zipArchive = new \ZipArchive();
        $zipFile = $this->container->getParameter('kernel.project_dir') . '/public/cnmci/' . uniqid() . '.zip';
        if(file_exists($zipFile)) \unlink($zipFile);
        if($zipArchive->open($zipFile, \ZipArchive::CREATE)) {
            if(file_exists($file)) $zipArchive->addFile($file, 'matrice_encaissement.xls');
            $zipArchive->close();
            return $zipFile;
        }
        return null;
    }


    /**
     * @param int|null $artisan_id
     * @param string|null $cnmci_crm
     * @param string|null $cnmci_numero_rm
     * @param string|null $cnmci_carte_professionelle
     * @return bool
     */
    public function validateEnrolement(?int $artisan_id, ?string $cnmci_crm, ?string $cnmci_numero_rm, ?string $cnmci_carte_professionelle)
    {
        try {
//            $cnmci_carte_date_emission = new \DateTime();
//            $cnmci_carte_date_expiration = new \DateTime();
//            $cnmci_carte_date_expiration = $cnmci_carte_date_expiration->add(new DateInterval("P1Y"));

            $artisan = $this->artisanRepository->find($artisan_id);
            $artisan->setCnmciNumeroRm($cnmci_numero_rm);
            $artisan->setCnmciCrm($cnmci_crm);
//          $artisan->setCnmciCarteDateExpiration($cnmci_carte_date_expiration);
//          $artisan->setCnmciCarteDateEmission($cnmci_carte_date_emission);
            $artisan->setCnmciNumeroCarteProfessionelle($cnmci_carte_professionelle);
            $artisan->setStatus(StatutArtisan::ENROLEMENT_VALIDER_CNMCI->value);
            $this->artisanRepository->add($artisan, true);
            $this->generateSingleCnmciCard($artisan);
            return true;
        }catch(\Exception $e){
            return false;
        }
    }

    /**
     * @param int $artisan_id
     * @param string $cnmci_carte_professionelle
     * @return bool
     */
    public function rejectEnrolement(int $artisan_id, string $reason)
    {
        try {
            $artisan = $this->artisanRepository->find($artisan_id);
            $artisan->setEnrolementRejectedReason($reason);
            $artisan->setStatus(StatutArtisan::ENROLEMENT_REJETE_CNMCI->value);
            $this->artisanRepository->add($artisan, true);
            return true;
        }catch(\Exception $e){
            return false;
        }
    }

    /**
     * @param int $artisan_id
     * @param string $cnmci_carte_professionelle
     * @return bool
     */
    public function rejectPayment(int $artisan_id, string $reason)
    {
        try {
            $artisan = $this->artisanRepository->find($artisan_id);
            $artisan->setEnrolementRejectedReason($reason);
            $artisan->setStatus(StatutArtisan::ENROLEMENT_PAIEMENT_REJETE_CNMCI->value);
            $this->artisanRepository->add($artisan, true);
            return true;
        }catch(\Exception $e){
            return false;
        }
    }

    /**
     * @param Artisan $artisan
     * @return void
     */
    public function validatePayment(Artisan $artisan) {
        $artisan->setStatus(StatutArtisan::ENROLEMENT_PAIEMENT_VALIDER_CNMCI->value);
        $this->artisanRepository->add($artisan, true);
    }

    /**
     * @param Artisan $artisan
     * @param bool $card_produced
     * @return void
     */
    public function carteProduced(Artisan $artisan, bool $card_produced) {
        $artisan->setIsCardProduced($card_produced);
        $this->artisanRepository->add($artisan, true);
    }

    /**
     * @param Artisan $artisan
     * @param bool $registre_produced
     * @return void
     */
    public function registreProduced(Artisan $artisan, bool $registre_produced) {
        $artisan->setIsRegistreProduced($registre_produced);
        $this->artisanRepository->add($artisan, true);
    }

    /**
     * @param array $ids
     * @return void
     */
    public function validatePaymentBatch(array $ids) {
        $this->artisanRepository->validatePaymentByIds($ids);
    }

    /**
     * @param array $ids
     * @return void
     */
    public function validateEnrolementBatch(array $ids) {
        $this->artisanRepository->validateEnrolementByIds($ids);
    }

    /**
     * @param $artisans
     * @return string|null
     */
    public function generateMatriceEncaissementXlsxFile($artisans): ?string
    {
        try {

            $dir = $this->getCnmciDir();
            if (!file_exists($dir)) mkdir($dir, 0777, true);

            $inputFileName = $dir . "CNMCI-Matrice des encaissements.xls";
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            $spreadsheet = $reader->load($inputFileName);
            $worksheet = $spreadsheet->getSheet(0);

            $count = 1;
            $cel = 3;
            /** @var Artisan $artisan */
            foreach ($artisans as $artisan) {
                $d = [
                    $count++,
                    "Registre des metiers et Carte d Artisans",
                    '15000',
                    $artisan->getPaymentReceiptCnmciCode(), //$row['payment_receipt_cnmci_code']  $artisan->get,
                    $artisan->getSubscriptionDate()->format('d/m/Y'), //$row['subscription_date']->format('d/m/Y'),
                    $artisan->getLastName() . '' . $artisan->getFirstName(),
                    $artisan->getActivity(),
                    $artisan->getActivityGeoLocation(),
                    $artisan->getMobile(),
                    '',
                ];

                $worksheet->fromArray(
                    $d,             // The data to set
                    NULL,        // Array values with this value will not be set
                    "A" . $cel++         // Top left coordinate of the worksheet range where we want to set these values (default is A1)
                );
            }

            $spreadsheet->getActiveSheet()->setAutoFilter(
                $spreadsheet->getActiveSheet()->calculateWorksheetDimension()
            );

            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);
            $outputFileName = $dir . time() . uniqid() . ".xls";

            if (file_exists($outputFileName)) \unlink($outputFileName);
            $writer->save($outputFileName);

            $spreadsheet->disconnectWorksheets();
            unset($spreadsheet);

            return $outputFileName;

        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        return null;
    }

    /**
     * @param $artisans
     * @return string|null
     */
    public function generateAdherentListXlsxFile($artisans): ?string
    {
        try {
            $dir = $this->getCnmciDir();
            if (!file_exists($dir)) mkdir($dir, 0777, true);

            $inputFileName = $dir . "CNMCI-Matrice des inscrits.xls";

            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            $spreadsheet = $reader->load($inputFileName);
            $worksheet = $spreadsheet->getSheet(0);

            $count = 1;
            $cel = 3;
            /** @var Artisan $artisan * */
            foreach ($artisans as $artisan) {
                try {
                    $d = [
                        "N°" => $count++,
                        "EMAIL" => $artisan->getEmail(),
                        "NOM" => $artisan->getLastName(),
                        "PRENOMS" => $artisan->getFirstName(),
                        "ACTIVITE" => $artisan->getActivity(),
                        "DATE SOUSCRIPTION" => $artisan->getSubscriptionDate()?->format('d/m/Y'),
                        "SEXE" => $artisan->getSex(),
                        "PHOTO" => $artisan->getPhoto(),
                        "DATE DE NAISSANCE" => $artisan->getDateOfBirth()?->format('d/m/Y'),
                        "VILLE NAISSANCE" => $artisan->getBirthLocality(),
                        "N° PERMIS DE CONDUIRE" => $artisan->getDrivingLicenseNumber(),
                        "NUMERO PIECE D'IDENTITE" => $artisan->getIdNumber(),
                        "TYPE DE PIECE" => $artisan->getIdType(),
                        "PAYS" => $artisan->getCountry(),
                        "VILLE" => $artisan->getCity(),
                        "COMMUNE" => $artisan->getCommune(),
                        "MOBILE" => $artisan->getMobile(),
                        "TEL" => $artisan->getPhone(),
                        "PHOTO PIECE RECTO" => $artisan->getPhotoPieceFront(),
                        "PHOTO PIECE VERSO" => $artisan->getPhotoPieceBack(),
                        "PHOTO PERMIS RECTO" => $artisan->getPhotoPermisFront(),
                        "PHOTO PERMIS VERSO" => $artisan->getPhotoPermisBack(),
                        "NATIONALITE" => $artisan->getNationality(),
                        "QUARTIER DE RESIDENCE" => $artisan->getQuartier(),
                        "WHATSAPP" => $artisan->getWhatsapp(),
                        "ENTREPRISES" => !empty($artisan->getCompany()) ? implode("|", $artisan->getCompany()): '',
                        "NOM CONJOINT" => $artisan->getPartnerLastName(),
                        "PRENOMS CONJOINT" => $artisan->getFirstName(),
                        "LIEU DE DELIVRANCE PIECE" => $artisan->getIdDeliveryPlace(),
                        "DATE DE DELIVRANCE PIECE" => $artisan->getIdDeliveryDate()?->format('d/m/Y'),
                        "ETAT CIVIL" => $artisan->getEtatCivil(),
                        "REFERENCE" => $artisan->getReference(),
                        "PAYS DE NAISSANCE" => $artisan->getIdDeliveryPlace(),
                        "LOCALITE NAISSANCE" => $artisan->getBirthLocality(),
                        "AUTORITE DE DELIVRANCE PIECE" => $artisan->getIdDeliveryAuthority(),
                        "BOITE POSTALE" => $artisan->getPostalCode(),
                        "PAIEMENT ORANGE MONEY" => $artisan->getPaymentReceiptCnmciCode(),
                        "LOCALISATION GEOGRAPHIQUE DE L'ACTIVITE" => $artisan->getIdDeliveryPlace(),
                        "PAYS DE L'ACTIVITE" => $artisan->getActivityCountryLocation(),
                        "VILLE DE L'ACTIVITE" => $artisan->getActivityCityLocation(),
                        "QUARTIER DE L'ACTIVITE" => $artisan->getActivityQuartierLocation(),
                        "CATEGORIE SOCIOPROFESSIONNELLE" => $artisan->getSocioprofessionnelleCategory(),
                        "DATE DEBUT ACTIVITE " => $artisan->getActivityDateDebut()?->format('d/m/Y'),
                        "PRENOMS PERSONNE A CONTACTER" => $artisan->getPartnerFirstName(),
                        "NOM PERSONNE A CONTACTER" => $artisan->getPartnerLastName(),
                        //    "TELEPHONE PERSONNE A CONTACTER" => "",
                        //    "RECU ORANGE MONEY" => "",
                        //    "FORMULAIRE CNMCI" => "",
                        //    "DOCUMENTS" => "",
                        //    "DOCUMENTS IDENTITE" => ""
                    ];
                    $r = array_values($d);
                    $worksheet->fromArray(
                        $r,     // The data to set
                        NULL,               // Array values with this value will not be set
                        "A" . $cel++     // Top left coordinate of the worksheet range where we want to set these values (default is A1)
                    );

                } catch (\Exception $e) {
                    echo $e->getMessage() . PHP_EOL;
                }
            }

            $spreadsheet->getActiveSheet()->setAutoFilter($spreadsheet->getActiveSheet()->calculateWorksheetDimension());
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);
            $outputFileName = $dir . uniqid(). ".xls";
            if (file_exists($outputFileName)) \unlink($outputFileName);
            $writer->save($outputFileName);

            $spreadsheet->disconnectWorksheets();
            unset($spreadsheet);

            return $outputFileName;

        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        return null;
    }

    /**
     * @return string
     */
    public function getCnmciDir()
    {
        return $this->container->getParameter("kernel.project_dir") . "/public/cnmci/";
    }

    /**
     * @param Artisan|null $artisan
     * @return string
     */
    public function getArtisanDir(?Artisan $artisan): string
    {
        return $this->artisanAssetHelper->getArtisanDir($artisan);
    }

    /**
     * @param Artisan $artisan
     * @return bool
     */
    public function sendEnrolementConfirmationEmail(Artisan $artisan){

        $file = $this->artisanAssetHelper->getArtisanDir($artisan)  . $artisan->getPaymentReceiptServiceTechniquePdf();
        if(file_exists($file)) {
            $emailService = $this->emailService->sendEmail(
                'info@sfpci.com',
                $artisan->getEmail(),
                "Enrôlement à la Chambre Nationale de métiers de Côte d'Ivoire",
                "<p>Bonjour <strong>{$artisan->getLastName()} {$artisan->getFirstName()}</strong><br><br> Votre enrôlement à la chambre Nationale de métiers a été effectué avec succès.<br>Vous trouverez en pièce jointe à ce courriel, votre reçu d'enrôlement.<br>Merci.</p>",
                $file
            );
            return true;
        }
        return false;
    }

    /**
     * @param string $file
     * @param \ZipArchive $zipArchive
     * @param string $outputFile
     */
    public function addToArchive(string $file, \ZipArchive& $zipArchive, string $outputFile)
    {
        if (is_file($file)) {
            $name = $outputFile . pathinfo($file, PATHINFO_EXTENSION);
            $zipArchive->addFile($file, $name);
            unset($info);
        }
    }
}

