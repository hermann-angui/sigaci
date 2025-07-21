<?php

namespace App\Service\ConfigurationService;

use App\Repository\ConfigurationRepository;
use App\Service\AbstractService;

/**
 *
 */
class ConfigurationService extends AbstractService
{
    public function __construct(private ConfigurationRepository $configurationRepository)
    {
        parent::__construct($configurationRepository);
    }

    public function getParameter(string $name)
    {
       $configuration = $this->configurationRepository->findOneBy(['name' => $name]);

       if($configuration){
           return match ($configuration->getType()) {
               'int' => (int)$configuration?->getValue(),
               'float' => (float)$configuration?->getValue(),
               'datetime' => new \DateTime($configuration?->getValue()),
               'boolean' => boolval($configuration?->getValue()),
               'string' => (string) $configuration?->getValue(),
               default => $configuration?->getValue(),
           };
       }
       return null;
    }

}

