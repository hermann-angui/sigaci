<?php

namespace App\EventSubscriber;


use ApiPlatform\Symfony\EventListener\EventPriorities;
use App\Entity\Identification;
use App\Message\SendSmsMessage;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Messenger\MessageBusInterface;

class IdentificationSubscriber implements EventSubscriberInterface
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

        $identification = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        /* @var Identification $entity **/
        if (!$identification instanceof Identification || Request::METHOD_POST !== $method) {
            return;
        }

//        if (!$entity instanceof Identification) {
//            return;
//        }
        $artisan = $identification->getArtisan();
        $fullName = $artisan->getNom() . ' ' . $artisan->getPrenoms();
        $reference = $identification->getReference();
        $message = sprintf("Bravo %s! Vous êtes identifié à la CNMCI avec le code %s.", $fullName, $reference);
       // $number = $artisan->getWhatsapp();
        $number = '+2250545338073';
        $this->bus->dispatch(new SendSmsMessage($number, $message));
    }
}
