<?php

namespace App\EventSubscriber;


use ApiPlatform\Symfony\EventListener\EventPriorities;
use App\Entity\Immatriculation;
use App\Message\SendSmsMessage;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Messenger\MessageBusInterface;

class ImmatriculationSubscriber implements EventSubscriberInterface
{
    public function __construct(private MessageBusInterface $bus) {}

    public static function getSubscribedEvents(): array
    {
       // return [Events::postPersist];
        return [
            KernelEvents::VIEW => ['postPersist', EventPriorities::POST_WRITE],
        ];
    }
   // public function postPersist(LifecycleEventArgs $args): void
    public function postPersist(ViewEvent $event): void
    {
       // $entity = $args->getObject();

        $immatriculation = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        /* @var Immatriculation $entity **/
        if (!$immatriculation instanceof Immatriculation || Request::METHOD_POST !== $method) {
            return;
        }

//        if (!$entity instanceof Identification) {
//            return;
//        }
        $artisan = $immatriculation->getArtisan();
        $fullName = $artisan->getNom() . ' ' . $artisan->getPrenoms();
        $reference = $immatriculation->getReference();
        $link = "https://cnmci.sfpci.com/suivi/immatriculation/" . $immatriculation->getReference();
        $message = sprintf("Bravo %s! Vous êtes immatriculé à la CNMCI avec le code %s. Cliquez ici pour voir suivre votre demande %s", $fullName, $reference, $link);
        $number = $artisan->getWhatsapp();
        $this->bus->dispatch(new SendSmsMessage($number, $message));
    }
}
