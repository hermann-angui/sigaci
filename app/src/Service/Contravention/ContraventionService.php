<?php

namespace App\Service\Contravention;

use App\Entity\Contravention;
use App\Entity\Payment;
use App\Repository\ContraventionRepository;
use App\Service\AbstractService;
use App\Service\Payment\PaymentService;
use Symfony\Component\Uid\Uuid;

class ContraventionService extends AbstractService
{
  public function __construct(private ContraventionRepository $contraventionRepository ,
                              private PaymentService $paymentService)
  {
      parent::__construct($contraventionRepository);
  }

  public function generateContraventionReceipt(Contravention $contravention): ?string
  {
      $payment = $this->paymentService->findPaymentByTarget($contravention->getContraventionNumero());
      if(!$payment){
          $payment = new Payment();
          $payment->setStatus('PAID');
          $payment->setCreatedAt(new \DateTime());
          $payment->setModifiedAt(new \DateTime());
          if($contravention->getTarget()) $payment->setTarget($contravention->getTarget()->getId());
          $payment->setMontant($contravention->getMontantContravention());
          $payment->setCodePaymentOperateur($contravention->getCodePaiementMobileMoney());
          $payment->setOperateur(null);
          $payment->setType('MOBILE MONEY');
          $payment->setReference(Uuid::v4()->toRfc4122());
          $this->paymentService->store($payment);
      }

      return $this->paymentService->generateReceiptContravention($payment, $contravention);
  }
}