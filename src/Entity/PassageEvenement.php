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

    #[ORM\ManyToOne(inversedBy: 'passageEvenements')]
    private ?Evenement $Evenement = null;

    #[ORM\OneToMany(mappedBy: 'PassageEvenement', targetEntity: ReservationEvenement::class, cascade: ['remove'])]
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

    public function getEvenement(): ?Evenement
    {
        return $this->Evenement;
    }

    public function setEvenement(?Evenement $Evenement): static
    {
        $this->Evenement = $Evenement;

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
            $reservationEvenement->setPassageEvenement($this);
        }

        return $this;
    }

    public function removeReservationEvenement(ReservationEvenement $reservationEvenement): static
    {
        if ($this->reservationEvenements->removeElement($reservationEvenement)) {
            // set the owning side to null (unless already changed)
            if ($reservationEvenement->getPassageEvenement() === $this) {
                $reservationEvenement->setPassageEvenement(null);
            }
        }

        return $this;
    }

}
