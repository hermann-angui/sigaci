<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\VillesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: VillesRepository::class)]
#[ORM\Table(name: '`pays`')]
#[UniqueEntity(fields: ['name'])]
#[ORM\HasLifecycleCallbacks()]
#[ApiResource]
class Pays
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

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
}
