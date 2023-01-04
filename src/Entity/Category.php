<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[Vich\Uploadable]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\ManyToMany(targetEntity: Peinture::class, mappedBy: 'categorie')]
    private Collection $peintures;

    #[ORM\ManyToMany(targetEntity: Sculpture::class, mappedBy: 'categorie')]
    private Collection $sculptures;

    public function __construct()
    {
        $this->peintures = new ArrayCollection();
        $this->sculptures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, Peinture>
     */
    public function getPeintures(): Collection
    {
        return $this->peintures;
    }

    public function addPeinture(Peinture $peinture): self
    {
        if (!$this->peintures->contains($peinture)) {
            $this->peintures->add($peinture);
            $peinture->addCategorie($this);
        }

        return $this;
    }

    public function removePeinture(Peinture $peinture): self
    {
        if ($this->peintures->removeElement($peinture)) {
            $peinture->removeCategorie($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Sculpture>
     */
    public function getSculptures(): Collection
    {
        return $this->sculptures;
    }

    public function addSculpture(Sculpture $sculpture): self
    {
        if (!$this->sculptures->contains($sculpture)) {
            $this->sculptures->add($sculpture);
            $sculpture->addCategorie($this);
        }

        return $this;
    }

    public function removeSculpture(Sculpture $sculpture): self
    {
        if ($this->sculptures->removeElement($sculpture)) {
            $sculpture->removeCategorie($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }
}
