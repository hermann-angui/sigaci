<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\NationalitiesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: NationalitiesRepository::class)]
#[ORM\Table(name: '`nationalites`')]
#[UniqueEntity(fields: ['name'])]
#[ORM\HasLifecycleCallbacks()]
#[ApiResource()]
class Nationalities
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 10)]
    private string $code;

    public function __construct()
    {
        $this->code = substr(bin2hex(random_bytes(10)), 0, 10);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return Nationalities
     */
    public function setCode(string $code): Nationalities
    {
        $this->code = $code;
        return $this;
    }


}
