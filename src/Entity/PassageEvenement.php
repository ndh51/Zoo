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
    private ?Evenement $evenement = null;

    #[ORM\OneToMany(mappedBy: 'passageEvenement', targetEntity: ReservationEvenement::class, cascade: ['remove'])]
    private Collection $reservationEvenement;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datePassage = null;

    public function __construct()
    {
        $this->reservationEvenement = new ArrayCollection();
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
        return $this->evenement;
    }

    public function setEvenement(?Evenement $evenement): static
    {
        $this->evenement = $evenement;

        return $this;
    }

    /**
     * @return Collection<int, ReservationEvenement>
     */
    public function getReservationEvenements(): Collection
    {
        return $this->reservationEvenement;
    }

    public function addReservationEvenement(ReservationEvenement $reservationEvenement): static
    {
        if (!$this->reservationEvenement->contains($reservationEvenement)) {
            $this->reservationEvenement->add($reservationEvenement);
            $reservationEvenement->setPassageEvenement($this);
        }

        return $this;
    }

    public function removeReservationEvenement(ReservationEvenement $reservationEvenement): static
    {
        if ($this->reservationEvenement->removeElement($reservationEvenement)) {
            // set the owning side to null (unless already changed)
            if ($reservationEvenement->getPassageEvenement() === $this) {
                $reservationEvenement->setPassageEvenement(null);
            }
        }

        return $this;
    }

    public function getDatePassage(): ?\DateTimeInterface
    {
        return $this->datePassage;
    }

    public function setDatePassage(\DateTimeInterface $datePassage): static
    {
        $this->datePassage = $datePassage;

        return $this;
    }

}
