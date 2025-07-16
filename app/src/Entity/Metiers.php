<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MetiersRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: MetiersRepository::class)]
#[ORM\Table(name: '`metiers`')]
#[UniqueEntity(fields: ['name'])]
#[ORM\HasLifecycleCallbacks()]
#[ApiResource]
class Metiers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    private string $name;

    #[ORM\Column(type: "string", length: 500, nullable: true)]
    private ?string $description;

    #[ORM\ManyToOne(targetEntity: CorpsMetiers::class, inversedBy: 'metiers')]
    private ?CorpsMetiers $corpsMetiers = null;


    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;

    }

    public function getCorpsMetiers(): ?CorpsMetiers
    {
        return $this->corpsMetiers;
    }

    public function setCorpsMetiers(?CorpsMetiers $corpsMetiers): self
    {
        $this->corpsMetiers = $corpsMetiers;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param ?string $name
     * @return Metiers
     */
    public function setName(?string $name): Metiers
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Metiers
     */
    public function setDescription(string $description): Metiers
    {
        $this->description = $description;
        return $this;
    }


}
