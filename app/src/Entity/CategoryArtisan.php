<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CategoryArtisanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryArtisanRepository::class)]
#[ORM\Table(name: '`category_artisans`')]
#[ORM\HasLifecycleCallbacks()]
#[ApiResource]
class CategoryArtisan
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(nullable: true)]
    private ?string $name = null;

    /**
     * @var Collection<int, Artisan>
     */
    #[ORM\OneToMany(targetEntity: Artisan::class, mappedBy: 'categoryArtisan')]
    private Collection $artisans;

    public function __construct()
    {
        $this->artisans = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function addArtisan(Artisan $artisans): static
    {
        if (!$this->artisans->contains($artisans)) {
            $this->artisans->add($artisans);
            $artisans->setCategoryArtisan($this);
        }

        return $this;
    }

    public function removeArtisan(Artisan $artisans): static
    {
        if ($this->artisans->removeElement($artisans)) {
            // set the owning side to null (unless already changed)
            if ($artisans->getCategoryArtisan() === $this) {
                $artisans->setCategoryArtisan(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getArtisans(): Collection
    {
        return $this->artisans;
    }

    /**
     * @param Collection $artisans
     * @return CategoryArtisan
     */
    public function setArtisans(Collection $artisans): CategoryArtisan
    {
        $this->artisans = $artisans;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return CategoryArtisan
     */
    public function setName(?string $name): CategoryArtisan
    {
        $this->name = $name;
        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
