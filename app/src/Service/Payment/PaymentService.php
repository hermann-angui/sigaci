<?php

namespace App\Service\Payment;

use App\Entity\Artisan;
use App\Entity\Contravention;
use App\Entity\Enrolement;
use App\Entity\Payment;
use App\Entity\User;
use App\Helper\ArtisanAssetHelper;
use App\Helper\FileHelper;
use App\Helper\PdfGenerator;
use App\Repository\ArtisanRepository;
use App\Repository\PaymentRepository;
use App\Service\AbstractService;
use App\Service\ConfigurationService\ConfigurationService;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

class PaymentService extends AbstractService
{
    public function __construct(private PdfGenerator         $pdfGenerator,
                                private ArtisanRepository    $artisanRepository,
                                private ArtisanAssetHelper   $artisanAssetHelper,
                                private ConfigurationService $configurationService,
                                private PaymentRepository    $paymentRepository)
    {
        parent::__construct($paymentRepository);
    }

    /**
     * @return string
     */
    public static function generateReference() {
        return str_replace("-", "", substr(Uuid::v4()->toRfc4122(), 0, 18));
    }

    public function storeReceiptFile(Payment $payment, File $file): Payment
    {
        $artisan = $payment->getPaymentFor();
        $fileName = $this->artisanAssetHelper->uploadAsset($file, $artisan->getReference());
        if ($fileName) {
            $existingFile = $payment->getReceiptFile() ? $this->artisanAssetHelper->getArtisanDir($artisan) . $payment->getReceiptFile(): null;
            if(file_exists($existingFile)) unlink($existingFile);
            $payment->setReceiptFile($fileName->getFilename());
        }
        return $artisan;
    }

    /**
     * @param Payment|null $payment
     * @return PdfResponse
     */
    public function downloadArtisanPaymentReceipt(?Payment $payment) {
        set_time_limit(0);
        $content = $this->generateReceiptEnrolement($payment);
        return new PdfResponse($content, 'recu_enrolement_artisan.pdf');
    }

     /**
     * @param Payment|null $payment
     * @return string|null
     */
    public function generateReceiptEnrolement(?Payment $payment): ?string
    {
        try {
            $barcode_file = null;
            $receipt_file = null;
            $artisan = $payment->getPaymentFor();
            $folder = $this->artisanAssetHelper->getArtisanDir($artisan);

            $file = $folder . $payment->getReceiptFile();
            if($payment->getReceiptFile() && is_file($file)){
                $content =  file_get_contents($file);
            }else{
                $qrCodeData = $this->configurationService->getParameter('app.base_url') . "profile/" . $artisan->getReference();
                $content = $this->pdfGenerator->generateBarCode($qrCodeData, 50, 50);
                if(!file_exists($folder)) mkdir($folder, 0777, true);
                $barcode_file = $folder . "payment_barcode.png";
                file_put_contents($barcode_file, $content);

                $receipt_file = $folder . time() . uniqid() . ".pdf";
                $payment->setReceiptFile(basename($receipt_file));
                $this->paymentRepository->add($payment, true);

                $content = $this->pdfGenerator->generatePdf('admin/payment/payment-receipt-service-technique-pdf.html.twig', ['payment' => $payment]);
                file_put_contents($receipt_file, $content);

                FileHelper::deleteExistingFile($barcode_file);
            }
            return $content ?? null;

        } catch(\Exception $e) {
            if($barcode_file) FileHelper::deleteExistingFile($barcode_file);
            if($receipt_file) FileHelper::deleteExistingFile($receipt_file);
        }
        return null;
    }

    /**
     * @param Payment|null $payment
     * @return string|null
     */
    public function generateReceiptContravention(?Payment $payment, Contravention $contravention): ?string
    {
        try {
            $barcode_file = null;
            $receipt_file = null;
            $folder = '/var/www/html/public/contraventions/';
            if(!file_exists($folder)) mkdir($folder, 0777, true);

            $file_basename = $folder . $payment->getReference();
            $receipt_file = $file_basename . '.pdf';
            if(is_file($receipt_file)){
                $content =  file_get_contents($receipt_file);
            }else{
                $qrCodeData = $this->configurationService->getParameter('app.base_url') . "contravention/" . $contravention->getContraventionNumero();
                $content = $this->pdfGenerator->generateBarCode($qrCodeData, 50, 50);
                if(!file_exists($folder)) mkdir($folder, 0777, true);
                $barcode_file = $file_basename . "_barcode.png";
                file_put_contents($barcode_file, $content);


                $content = $this->pdfGenerator->generatePdf('contravention/receipt_contravention_pdf.html.twig', ['contravention' => $contravention]);
                file_put_contents($receipt_file, $content);
                $payment->setReceiptFile(basename($receipt_file));
                $this->paymentRepository->add($payment, true);

                FileHelper::deleteExistingFile($barcode_file);
            }
            return $receipt_file ?? null;

        } catch(\Exception $e) {
            if($barcode_file) FileHelper::deleteExistingFile($barcode_file);
            if($receipt_file) FileHelper::deleteExistingFile($receipt_file);
        }
        return null;
    }

    /**
     * @param Payment $payment
     * @return void
     */
    public function store(Payment $payment): void
    {
         $this->paymentRepository->add($payment, true);
    }

    /**
     * @param Artisan|null $artisan
     * @param UserInterface|null $user
     * @param int|null $montant
     * @param string|null $reference
     * @param string|null $target
     * @param string|null $status
     * @param string|null $type
     * @param string|null $operateur
     * @return Payment
     */
    public function savePayment(?Enrolement $enrolement, ?User $user, ?int $montant, ?string $reference, ?string $target, ?string $status, ?string $type, ?string $operateur): Payment {
        $payment = new Payment();

        $artisan = $enrolement->getArtisan();
        $payment->setReference($reference?:$this->generateReference())
                ->setUser($user)
                ->setType(strtoupper($type))
                ->setMontant($montant)
                ->setTarget($target)
                ->setPaymentFor($artisan)
                ->setStatus($status)
                ->setOperateur($operateur)
                ->setCodePaymentOperateur(null)
                ->setReceiptNumber($this->generateReference())
                ->setReceiptFile(null)
                ->setCreatedAt(new \DateTime('now'))
                ->setModifiedAt(new \DateTime('now'));
        $this->store($payment);

     // $this->storeReceiptFile($payment, new File('/var/www/html/public/member/' . $artisan->getReference() .'/'. $enrolement->getMobileMoneyReceiptPdf()));
        return $payment;
    }

    /**
     * @param Artisan|null $artisan
     * @param UserInterface|null $user
     * @param int|null $montant
     * @param string|null $reference
     * @param string|null $target
     * @return Payment
     */
    public function cashIn(?Artisan $artisan, Enrolement $enrolement, ?User $user, ?int $montant, ?string $reference, ?string $target): Payment {
        $payment = new Payment();
        $payment
            ->setReference($reference?:$this->generateReference())
            ->setUser($user)
            ->setType("CASH")
            ->setMontant($montant)
            ->setTarget($target)
            ->setPaymentFor($artisan)
            ->setStatus('PAID')
            ->setOperateur(null)
            ->setCodePaymentOperateur(null)
            ->setReceiptNumber($this->generateReference())
            ->setReceiptFile(null)
            ->setCreatedAt(new \DateTime('now'))
            ->setModifiedAt(new \DateTime('now'));
        $this->store($payment);
        return $payment;
    }

    /**
     * @param Artisan $artisan
     * @param string $target
     * @return Payment|null
     */
    public function  findArtisanPaymentByTarget(Artisan $artisan, string $target): ?Payment
    {
        return  $this->paymentRepository->findOneBy(['payment_for' => $artisan, 'target' => $target]);
    }

    /**
     * @param string $target
     * @return Payment|null
     */
    public function  findPaymentByTarget(string $target): ?Payment
    {
        return  $this->paymentRepository->findOneBy(['target' => $target]);

    }
}
