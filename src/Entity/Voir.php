<?php

namespace App\Entity;

use App\Repository\VoirRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoirRepository::class)]
class Voir
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'vues')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Animal $idAnimal = null;

    #[ORM\ManyToOne(inversedBy: 'vues')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ticket $idTicket = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdAnimal(): ?Animal
    {
        return $this->idAnimal;
    }

    public function setIdAnimal(?Animal $idAnimal): static
    {
        $this->idAnimal = $idAnimal;

        return $this;
    }

    public function getIdTicket(): ?Ticket
    {
        return $this->idTicket;
    }

    public function setIdTicket(?Ticket $idTicket): static
    {
        $this->idTicket = $idTicket;

        return $this;
    }
}
