<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Entity\Entreprise;

class EntrepriseDtoStateProvider implements ProviderInterface
{
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        // Retrieve the state from somewhere
        echo "fr";
        return new Entreprise();
    }
}
