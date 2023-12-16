<?php

namespace App\Entity;

use App\Repository\ReservationEvenementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationEvenementRepository::class)]
class ReservationEvenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'reservationEvenements')]
    private ?Ticket $idTicket = null;

    #[ORM\ManyToOne(inversedBy: 'reservationEvenements')]
    private ?PassageEvenement $idPassageEvenement = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdPassageEvenement(): ?PassageEvenement
    {
        return $this->idPassageEvenement;
    }

    public function setIdPassageEvenement(?PassageEvenement $idPassageEvenement): static
    {
        $this->idPassageEvenement = $idPassageEvenement;

        return $this;
    }

}
