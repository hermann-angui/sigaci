<?php

namespace App\Naming;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Uid\Uuid;
use Vich\UploaderBundle\FileAbstraction\ReplacingFile;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\NamerInterface;
use Vich\UploaderBundle\Util\Transliterator;

/**
 * This namer makes filename unique by appending a uniqueid.
 * Also, filename is made web-friendly by transliteration.
 *
 * @author Angui hermann <garakkio@gmail.com>
 */
final class CustomUniqueNamer implements NamerInterface
{
    private static array $keep = [
        'txt' => 'csv',
        'xml' => 'gpx',
    ];

    /**
     * @var Transliterator
     */
    private $transliterator;

    public function __construct(Transliterator $transliterator)
    {
        $this->transliterator = $transliterator;
    }

    /**
     * Guess the extension of the given file.
     */
    private function getExtension(File $file): ?string
    {
        if (!$file instanceof UploadedFile && !$file instanceof ReplacingFile) {
            throw new \InvalidArgumentException('Unexpected type for $file: '.$file::class);
        }

        if ('' !== ($extension = $file->guessExtension())) {
            if (isset(self::$keep[$extension])) {
                $originalExtension = \pathinfo($file->getClientOriginalName(), \PATHINFO_EXTENSION);
                if (self::$keep[$extension] === $originalExtension) {
                    return $originalExtension;
                }
            }

            return $extension;
        }

        return null;
    }

    public function name(object|array $object, PropertyMapping $mapping): string
    {
        $file = $mapping->getFile($object);
        $originalExtension = $this->getExtension($file);
        $UuidName= $this->transliterator->transliterate(Uuid::v4()->toString());
        $uniqExtension = \is_string($originalExtension) && '' !== $originalExtension
            ?  $originalExtension : '';
        $smartName = \sprintf('%s.%s', $UuidName, $uniqExtension);

        // Check if smartName is an acceptable size (some filesystems accept a max of 255)
        if (\strlen($smartName) <= 255) {
            return $smartName;
        }

        return $UuidName;

    }
}
