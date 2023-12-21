<?php

namespace App\Entity;

use App\Repository\ReservationEvenementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationEvenementRepository::class)]
class ReservationEvenement
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'reservationEvenement')]
    private ?Ticket $ticket = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'reservationEvenement')]
    private ?PassageEvenement $passageEvenement = null;


    public function getTicket(): ?Ticket
    {
        return $this->ticket;
    }

    public function setTicket(?Ticket $ticket): static
    {
        $this->ticket = $ticket;

        return $this;
    }

    public function getPassageEvenement(): ?PassageEvenement
    {
        return $this->passageEvenement;
    }

    public function setPassageEvenement(?PassageEvenement $passageEvenement): static
    {
        $this->passageEvenement = $passageEvenement;

        return $this;
    }

}
