<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
    )]
    private ?string $nomAnimal = null;
    #[Assert\Length(
        min: 5,
        max: 500,
    )]
    #[ORM\Column(length: 500, nullable: true)]
    private ?string $descAnimal = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    private ?Famille $idFamille = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    private ?Categorie $idCategorie = null;

    #[ORM\OneToMany(mappedBy: 'idAnimal', targetEntity: Participer::class)]
    private Collection $participations;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    private ?Image $idImage = null;
    #[ORM\ManyToOne(inversedBy: 'animals')]
    private ?Enclos $idEnclos = null;

    #[ORM\OneToMany(mappedBy: 'idAnimal', targetEntity: Voir::class)]
    private Collection $vues;

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function capitalizeNomAnimal(): void
    {
        $this->nomAnimal = ucfirst($this->nomAnimal);
    }

    public function __construct()
    {
        $this->participations = new ArrayCollection();
        $this->vues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAnimal(): ?string
    {
        return $this->nomAnimal;
    }

    public function setNomAnimal(string $nomAnimal): static
    {
        $this->nomAnimal = $nomAnimal;

        return $this;
    }

    public function getDescAnimal(): ?string
    {
        return $this->descAnimal;
    }

    public function setDescAnimal(?string $descAnimal): static
    {
        $this->descAnimal = $descAnimal;

        return $this;
    }

    public function getIdFamille(): ?Famille
    {
        return $this->idFamille;
    }

    public function setIdFamille(?Famille $idFamille): static
    {
        $this->idFamille = $idFamille;

        return $this;
    }

    public function getIdCategorie(): ?Categorie
    {
        return $this->idCategorie;
    }

    /**
     * @return Animal
     */
    public function setIdCategorie(?Categorie $idCategorie): static
    {
        $this->idCategorie = $idCategorie;

        return $this;
    }

    /**
     * @return Collection<int, Participer>
     */
    public function getParticipations(): Collection
    {
        return $this->participations;
    }

    public function addParticipation(Participer $participation): static
    {
        if (!$this->participations->contains($participation)) {
            $this->participations->add($participation);
            $participation->setAnimal($this);
        }

        return $this;
    }

    public function removeParticipation(Participer $participation): static
    {
        if ($this->participations->removeElement($participation)) {
            // set the owning side to null (unless already changed)
            if ($participation->getAnimal() === $this) {
                $participation->setAnimal(null);
            }
        }

        return $this;
    }

    public function getIdImage(): ?Image
    {
        return $this->idImage;
    }

    public function setIdImage(?Image $idImage): static
    {
        $this->idImage = $idImage;

        return $this;
    }

    public function getIdEnclos(): ?Enclos
    {
        return $this->idEnclos;
    }

    public function setIdEnclos(?Enclos $idEnclos): static
    {
        $this->idEnclos = $idEnclos;

        return $this;
    }

    /**
     * @return Collection<int, Voir>
     */
    public function getVues(): Collection
    {
        return $this->vues;
    }

    public function addVue(Voir $vue): static
    {
        if (!$this->vues->contains($vue)) {
            $this->vues->add($vue);
            $vue->setAnimal($this);
        }

        return $this;
    }

    public function removeVue(Voir $vue): static
    {
        if ($this->vues->removeElement($vue)) {
            // set the owning side to null (unless already changed)
            if ($vue->getAnimal() === $this) {
                $vue->setAnimal(null);
            }
        }

        return $this;
    }
}
