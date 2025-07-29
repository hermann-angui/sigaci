<?php

// src/OpenApi/OpenApiFactory.php
namespace App\OpenApi;

use ApiPlatform\OpenApi\Factory\OpenApiFactory as DecoratedOpenApiFactory;
use ApiPlatform\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\OpenApi\Model\PathItem;
use ApiPlatform\OpenApi\OpenApi;
use Symfony\Bundle\SecurityBundle\Security;

final class OpenApiFactory implements OpenApiFactoryInterface
{
    private $decorated;
    private $security;

    public function __construct(DecoratedOpenApiFactory $decorated, Security $security)
    {
        $this->decorated = $decorated;
        $this->security = $security;
    }

    public function __invoke(array $context = []): OpenApi
    {
        $openApi = ($this->decorated)($context);
        $paths = $openApi->getPaths();
//
//        /** @var PathItem $path */
//        foreach ($paths->getPaths() as $key => $path) {
//            // Example: Hide /admin endpoints from non-admin users
//            if (/*str_starts_with($key, '/admin') && */!$this->security->isGranted('ROLE_ADMIN')) {
//                $paths->addPath($key, $path->withGet(null)->withPost(null)->withPut(null)->withPatch(null)->withDelete(null)); // Remove all operations
//            }
//            // Add more complex logic based on specific roles and endpoints as needed
//        }

        return $openApi->withPaths($paths);
    }
}
