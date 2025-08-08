<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SousPrefectureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

#[ORM\Entity(repositoryClass: SousPrefectureRepository::class)]
#[ORM\Table(name: '`sous_prefecture`')]
#[ORM\HasLifecycleCallbacks()]
#[ApiResource()]
class SousPrefecture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 10)]
    private string $code;

    #[ORM\ManyToOne(inversedBy: 'sousPrefectures')]
    private ?Department $department = null;

    public function __construct()
    {
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return SousPrefecture
     */
    public function setId(?int $id): SousPrefecture
    {
        $this->id = $id;
        return $this;
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
     * @return SousPrefecture
     */
    public function setCode(string $code): SousPrefecture
    {
        $this->code = $code;
        return $this;
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(?Department $department): static
    {
        $this->department = $department;

        return $this;
    }


}
