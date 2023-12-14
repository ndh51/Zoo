<?php

namespace App\Entity;

use App\Repository\ParticiperRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParticiperRepository::class)]
class Participer
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'participations')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private ?Animal $animal = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'participations')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private ?Evenement $evenement = null;

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
