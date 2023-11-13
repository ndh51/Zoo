<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nomEvent = null;

    #[ORM\Column(length: 30)]
    private ?string $descEvent = null;

    #[ORM\Column]
    private ?int $nbPlaceMaxEvent = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEvent(): ?string
    {
        return $this->nomEvent;
    }

    public function setNomEvent(string $nomEvent): static
    {
        $this->nomEvent = $nomEvent;

        return $this;
    }

    public function getDescEvent(): ?string
    {
        return $this->descEvent;
    }

    public function setDescEvent(string $descEvent): static
    {
        $this->descEvent = $descEvent;

        return $this;
    }

    public function getNbPlaceMaxEvent(): ?int
    {
        return $this->nbPlaceMaxEvent;
    }

    public function setNbPlaceMaxEvent(int $nbPlaceMaxEvent): static
    {
        $this->nbPlaceMaxEvent = $nbPlaceMaxEvent;

        return $this;
    }
}
