<?php

namespace App\Entity;

use App\Repository\EnclosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EnclosRepository::class)]
class Enclos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Le nom de l\'enclos doit faire {{ limit }} caractères au minimum',
        maxMessage: 'Le nom de l\'enclos doit faire {{ limit }} caractères au maximum',
    )]
    private ?string $nomEnclos = null;

    #[ORM\OneToMany(mappedBy: 'enclos', targetEntity: Evenement::class, cascade: ['remove'])]
    private Collection $evenements;

    #[ORM\OneToMany(mappedBy: 'enclos', targetEntity: Animal::class, cascade: ['remove'])]
    private Collection $animals;

    public function __construct()
    {
        $this->evenements = new ArrayCollection();
        $this->animals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEnclos(): ?string
    {
        return $this->nomEnclos;
    }

    public function setNomEnclos(string $nomEnclos): static
    {
        $this->nomEnclos = $nomEnclos;

        return $this;
    }

    /**
     * @return Collection<int, Evenement>
     */
    public function getEvenements(): Collection
    {
        return $this->evenements;
    }

    public function addEvenement(Evenement $evenement): static
    {
        if (!$this->evenements->contains($evenement)) {
            $this->evenements->add($evenement);
            $evenement->setenclos($this);
        }

        return $this;
    }

    public function removeEvenement(Evenement $evenement): static
    {
        if ($this->evenements->removeElement($evenement)) {
            // set the owning side to null (unless already changed)
            if ($evenement->getenclos() === $this) {
                $evenement->setenclos(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Animal>
     */
    public function getAnimals(): Collection
    {
        return $this->animals;
    }

    public function addAnimal(Animal $animal): static
    {
        if (!$this->animals->contains($animal)) {
            $this->animals->add($animal);
            $animal->setenclos($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): static
    {
        if ($this->animals->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getenclos() === $this) {
                $animal->setenclos(null);
            }
        }

        return $this;
    }
}
