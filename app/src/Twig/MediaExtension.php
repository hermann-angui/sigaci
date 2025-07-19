<?php

declare(strict_types=1);

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Twig\TwigFilter;

class MediaExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('url', $this->url(...)),
        ];
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('mediaUrl', $this->url(...)),
        ];
    }

    public function url($path): string
    {
        return "/media/$path";
    }
}
