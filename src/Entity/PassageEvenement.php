<?php

namespace App\Entity;

use App\Repository\PassageEvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToOne(inversedBy: 'passageEvenements')]
    private ?Evenement $idEvenement = null;

    #[ORM\OneToMany(mappedBy: 'idPassageEvenement', targetEntity: ReservationEvenement::class)]
    private Collection $reservationEvenements;

    public function __construct()
    {
        $this->reservationEvenements = new ArrayCollection();
    }

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

    public function getIdEvenement(): ?Evenement
    {
        return $this->idEvenement;
    }

    public function setIdEvenement(?Evenement $idEvenement): static
    {
        $this->idEvenement = $idEvenement;

        return $this;
    }

    /**
     * @return Collection<int, ReservationEvenement>
     */
    public function getReservationEvenements(): Collection
    {
        return $this->reservationEvenements;
    }

    public function addReservationEvenement(ReservationEvenement $reservationEvenement): static
    {
        if (!$this->reservationEvenements->contains($reservationEvenement)) {
            $this->reservationEvenements->add($reservationEvenement);
            $reservationEvenement->setIdPassageEvenement($this);
        }

        return $this;
    }

    public function removeReservationEvenement(ReservationEvenement $reservationEvenement): static
    {
        if ($this->reservationEvenements->removeElement($reservationEvenement)) {
            // set the owning side to null (unless already changed)
            if ($reservationEvenement->getIdPassageEvenement() === $this) {
                $reservationEvenement->setIdPassageEvenement(null);
            }
        }

        return $this;
    }

}
