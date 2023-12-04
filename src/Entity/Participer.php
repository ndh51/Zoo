<?php

namespace App\Entity;

use App\Repository\ParticiperRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParticiperRepository::class)]
class Participer
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'participations')]
    // #[ORM\JoinColumn(name: 'animal_id', referencedColumnName: 'id')]
    private ?Animal $idAnimal = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'participations')]
    // #[ORM\JoinColumn(name: 'evenement_id', referencedColumnName: 'id')]
    private ?Evenement $idEvent = null;

    public function getIdAnimal(): ?Animal
    {
        return $this->idAnimal;
    }

    public function setIdAnimal(?Animal $idAnimal): static
    {
        $this->idAnimal = $idAnimal;

        return $this;
    }

    public function getIdEvent(): ?Evenement
    {
        return $this->idEvent;
    }

    public function setIdEvent(?Evenement $idEvent): static
    {
        $this->idEvent = $idEvent;

        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): static
    {
        $this->animal = $animal;

        return $this;
    }

    public function getEvenement(): ?Evenement
    {
        return $this->evenement;
    }

    public function setEvenement(?Evenement $evenement): static
    {
        $this->evenement = $evenement;

        return $this;
    }
}
