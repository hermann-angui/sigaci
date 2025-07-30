<?php
// src/Entity/MediaObject.php
namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Processor\MediaObjectProcessor;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use ApiPlatform\OpenApi\Model;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity]
#[Vich\Uploadable]
#[ORM\Table(name: '`media_objects`')]
#[ApiResource(
    types: ['https://schema.org/MediaObject'],
    operations: [
        new Get(),
        new GetCollection(),
        new Post(
            inputFormats: ['multipart' => ['multipart/form-data']],
            openapi: new Model\Operation(
                requestBody: new Model\RequestBody(
                    content: new \ArrayObject([
                        'multipart/form-data' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'file' => [
                                        'type' => 'string',
                                        'format' => 'binary'
                                    ]
                                ]
                            ]
                        ]
                    ])
                )
            ),
           // processor: MediaObjectProcessor::class
        )
    ],
   // outputFormats: ['jsonld' => ['application/ld+json']],
    normalizationContext: ['groups' => ['media_object:read']],
    // denormalizationContext: ['groups' => ['media_object:create','media_object:update', 'artisan:create', 'artisan:update']]
)]
class MediaObject
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    #[ApiProperty(writable: false, types: ['https://schema.org/contentUrl'])]
    #[Groups(['media_object:read'])]
    public ?string $contentUrl = null;

    #[Vich\UploadableField(mapping: 'media_object', fileNameProperty: 'filePath')]
    #[Assert\NotNull]
    public ?File $file = null;

    #[ApiProperty(writable: false)]
    #[ORM\Column(nullable: true)]
   // #[Groups(['media_object:read', 'user:read', 'artisan:read', 'artisan:create', 'artisan:update'])]
    public ?string $filePath = null;

    #[ORM\Column(nullable: true)]
   // #[Groups(['media_object:read'])]
    public ?string $mimeType = null;

    #[ORM\Column(nullable: true)]
   // #[Groups(['media_object:read'])]
    public ?string $type = null;

    #[ORM\Column(nullable: true)]
   // #[Groups(['media_object:read'])]
    public ?int $size = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    public ?DateTimeInterface $updated_at = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    public ?DateTimeInterface $created_at = null;

    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->updated_at = new \DateTime();
    }

    /**
     * Prepersist gets triggered on Insert
     * @ORM\PrePersist
     */
    public function updatedTimestamps()
    {
        if ($this->created_at == null) {
            $this->created_at = new \DateTime('now');
        }
        $this->updated_at = new \DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    /**
     * @param string|null $mimeType
     * @return MediaObject
     */
    public function setMimeType(?string $mimeType): MediaObject
    {
        $this->mimeType = $mimeType;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * @return MediaObject
     */
    public function setType(?string $type): MediaObject
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * @param int|null $size
     * @return MediaObject
     */
    public function setSize(?int $size): MediaObject
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updated_at;
    }

    /**
     * @param DateTimeInterface|null $updated_at
     * @return MediaObject
     */
    public function setUpdatedAt(?DateTimeInterface $updated_at): MediaObject
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->created_at;
    }

    /**
     * @param DateTimeInterface|null $created_at
     * @return MediaObject
     */
    public function setCreatedAt(?DateTimeInterface $created_at): MediaObject
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    /**
     * @param string|null $filePath
     * @return MediaObject
     */
    public function setFilePath(?string $filePath): MediaObject
    {
        $this->filePath = $filePath;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getContentUrl(): ?string
    {
        return $this->contentUrl;
    }

    /**
     * @param string|null $contentUrl
     * @return MediaObject
     */
    public function setContentUrl(?string $contentUrl): MediaObject
    {
        $this->contentUrl = $contentUrl;
        return $this;
    }

}
