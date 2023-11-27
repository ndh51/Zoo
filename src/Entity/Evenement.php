<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 5,
        max: 50,
    )]
    private ?string $nomEvent = null;

    #[Assert\NotBlank]
    #[Assert\Length(
        min: 10,
        max: 255,
    )]
    #[ORM\Column(length: 255)]
    private ?string $descEvent = null;

    #[ORM\Column]
    private ?int $nbPlaceMaxEvent = null;

    #[ORM\ManyToOne(inversedBy: 'evenements')]
    private ?Enclos $idEnclos = null;

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

    public function getIdEnclos(): ?Enclos
    {
        return $this->idEnclos;
    }

    public function setIdEnclos(?Enclos $idEnclos): static
    {
        $this->idEnclos = $idEnclos;

        return $this;
    }
}
