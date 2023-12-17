<?php

namespace App\Entity;

use App\Repository\ReservationEvenementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationEvenementRepository::class)]
class ReservationEvenement
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'reservationEvenements')]
    private ?Ticket $Ticket = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'reservationEvenements')]
    private ?PassageEvenement $PassageEvenement = null;


    public function getTicket(): ?Ticket
    {
        return $this->Ticket;
    }

    public function setTicket(?Ticket $Ticket): static
    {
        $this->Ticket = $Ticket;

        return $this;
    }

    public function getPassageEvenement(): ?PassageEvenement
    {
        return $this->PassageEvenement;
    }

    public function setPassageEvenement(?PassageEvenement $PassageEvenement): static
    {
        $this->PassageEvenement = $PassageEvenement;

        return $this;
    }

}
