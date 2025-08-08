<?php

namespace App\DTO;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use App\State\ObjectIdsStateProvider;

#[ApiResource(
    shortName: "Get all objects codes",
    operations: [
        new Get(
            uriTemplate: '/objects/codes',
            // controller: ObjectIdsController::class,
            output: ObjectIdsResponseDto::class,
            provider: ObjectIdsStateProvider::class
        ),
    ]
)]
class ObjectIdsRequestDto
{
}
