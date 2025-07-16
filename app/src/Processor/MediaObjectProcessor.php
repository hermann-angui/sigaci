<?php

namespace App\Processor;

use ApiPlatform\State\ProcessorInterface;
use ApiPlatform\Metadata\Operation;
use App\Entity\MediaObject;

class MediaObjectProcessor implements ProcessorInterface
{
    /**
     * @return MediaObject|void
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        // call your persistence layer to save $data
        return $data;
    }
}
