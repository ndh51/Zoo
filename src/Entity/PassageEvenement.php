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

    #[ORM\Column(length: 50)]
    #[Assert\Time]
    private ?string $hDebEvenement = null;

    #[ORM\Column(length: 50)]
    #[Assert\Time]
    private ?string $hFinEvenement = null;

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

    public function getHDebEvenement(): ?string
    {
        return $this->hDebEvenement;
    }

    public function setHDebEvenement(string $hDebEvenement): static
    {
        $this->hDebEvenement = $hDebEvenement;

        return $this;
    }

    public function getHFinEvenement(): ?string
    {
        return $this->hFinEvenement;
    }

    public function setHFinEvenement(string $hFinEvenement): static
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
