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

    #[ORM\Column(length: 30)]
    private ?string $dateDebEvent = null;

    #[ORM\Column(length: 30)]
    private ?string $dateFinEvent = null;

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

    public function getDateDebEvent(): ?string
    {
        return $this->dateDebEvent;
    }

    public function setDateDebEvent(string $dateDebEvent): static
    {
        $this->dateDebEvent = $dateDebEvent;

        return $this;
    }

    public function getDateFinEvent(): ?string
    {
        return $this->dateFinEvent;
    }

    public function setDateFinEvent(string $dateFinEvent): static
    {
        $this->dateFinEvent = $dateFinEvent;

        return $this;
    }
}
