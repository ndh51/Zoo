<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private ?Enclos $enclos = null;

    #[ORM\OneToMany(mappedBy: 'evenement', targetEntity: Participer::class, cascade: ['remove'])]
    private Collection $participations;

    #[ORM\ManyToOne(inversedBy: 'evenements')]
    private ?Image $image = null;

    #[ORM\OneToMany(mappedBy: 'evenement', targetEntity: PassageEvenement::class, cascade: ['remove'])]
    private Collection $passageEvenements;

    #[ORM\Column]
    private ?int $duree = null;

    public function __construct()
    {
        $this->participations = new ArrayCollection();
        $this->passageEvenements = new ArrayCollection();
    }

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

    public function getEnclos(): ?Enclos
    {
        return $this->enclos;
    }

    public function setEnclos(?Enclos $enclos): static
    {
        $this->enclos = $enclos;

        return $this;
    }

    /**
     * @return Collection<int, Participer>
     */
    public function getParticipations(): Collection
    {
        return $this->participations;
    }

    public function addParticipation(Participer $participation): static
    {
        if (!$this->participations->contains($participation)) {
            $this->participations->add($participation);
            $participation->setEvenement($this);
        }

        return $this;
    }

    public function removeParticipation(Participer $participation): static
    {
        if ($this->participations->removeElement($participation)) {
            // set the owning side to null (unless already changed)
            if ($participation->getEvenement() === $this) {
                $participation->setEvenement(null);
            }
        }

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, PassageEvenement>
     */
    public function getPassageEvenement(): Collection
    {
        return $this->passageEvenement;
    }

    public function addPassageEvenement(PassageEvenement $passageEvenement): static
    {
        if (!$this->passageEvenements->contains($passageEvenement)) {
            $this->passageEvenements->add($passageEvenement);
            $passageEvenement->setEvenement($this);
        }

        return $this;
    }

    public function removePassageEvenement(PassageEvenement $passageEvenement): static
    {
        if ($this->passageEvenements->removeElement($passageEvenement)) {
            // set the owning side to null (unless already changed)
            if ($passageEvenement->getEvenement() === $this) {
                $passageEvenement->setEvenement(null);
            }
        }

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): static
    {
        $this->duree = $duree;

        return $this;
    }
}
