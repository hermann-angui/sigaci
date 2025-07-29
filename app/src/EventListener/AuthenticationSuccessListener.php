<?php

namespace App\EventListener;

use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthenticationSuccessListener
{

    public function __construct(private UserRepository $userRepository, private UrlGeneratorInterface $router, private RequestStack $requestStack)
    {
    }

    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event): void
    {
        $data = $event->getData();
        $user = $event->getUser();

        if (!$user instanceof UserInterface) {
            return;
        }

        $user = $this->userRepository->find($user->getId());
        $schemeAndHttpPost = $this->requestStack->getCurrentRequest()->getSchemeAndHttpHost();

//      $data['id'] = $user->getId();
//      $data['nom'] = $user->getNom();
//      $data['prenoms'] = $user->getNom();
//      $data['photo'] = $user->getPhoto() ? $schemeAndHttpPost . '/media/' . $user->getPhoto()->getFilePath() : null;
//      $data['is_active'] = $user->getIsActive();
//      $data['sexe'] = $user->getSexe();
//      $data['roles'] = $user->getRoles();

        $event->setData($data);
    }
}
