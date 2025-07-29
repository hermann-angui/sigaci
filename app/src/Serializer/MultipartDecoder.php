<?php

namespace App\Serializer;

use Symfony\Component\Serializer\Encoder\DecoderInterface;

class MultipartDecoder implements DecoderInterface
{
    public const FORMAT = 'multipart';

    public function decode(string $data, string $format, array $context = []): mixed
    {
        $request = $context['request'] ?? null;

        if (!$request) {
            return [];
        }

        return array_merge(
            $request->request->all(),
            $request->files->all()
        );
    }

    public function supportsDecoding(string $format): bool
    {
        return self::FORMAT === $format;
    }
}
