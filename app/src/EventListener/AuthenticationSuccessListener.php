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
        // $host = $this->requestStack->getCurrentRequest()->getHost();
        $schemeAndHttpPost = $this->requestStack->getCurrentRequest()->getSchemeAndHttpHost();

        $extra = array(
            'id' => $user->getId(),
            'nom' => $user->getNom(),
            'prenoms' => $user->getNom(),
            'photo' => $user->getPhoto() ? $schemeAndHttpPost . '/media/' . $user->getPhoto()->getFilePath() : null,
            'is_active' => $user->getIsActive(),
            'sexe' => $user->getSexe(),
            'roles' => $user->getRoles(),
        );

        $data = array_merge($data, $extra);
        $event->setData($data);
    }
}
