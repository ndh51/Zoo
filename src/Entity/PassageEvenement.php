<?php

namespace App\Entity;

use App\Repository\PassageEvenementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PassageEvenementRepository::class)]
class PassageEvenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $hDebEvenement = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $hFinEvenement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHDebEvenement(): ?\DateTimeInterface
    {
        return $this->hDebEvenement;
    }

    public function setHDebEvenement(\DateTimeInterface $hDebEvenement): static
    {
        $this->hDebEvenement = $hDebEvenement;

        return $this;
    }

    public function getHFinEvenement(): ?\DateTimeInterface
    {
        return $this->hFinEvenement;
    }

    public function setHFinEvenement(\DateTimeInterface $hFinEvenement): static
    {
        $this->hFinEvenement = $hFinEvenement;

        return $this;
    }
}
