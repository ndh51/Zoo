<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateTicket = null;

    #[ORM\Column]
    private ?float $prixTicket = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Visiteur $visiteur = null;

    #[ORM\OneToMany(mappedBy: 'idTicket', targetEntity: Voir::class)]
    private Collection $vues;

    public function __construct()
    {
        $this->vues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateTicket(): ?\DateTimeInterface
    {
        return $this->dateTicket;
    }

    public function setDateTicket(\DateTimeInterface $dateTicket): static
    {
        $this->dateTicket = $dateTicket;

        return $this;
    }

    public function getPrixTicket(): ?float
    {
        return $this->prixTicket;
    }

    public function setPrixTicket(float $prixTicket): static
    {
        $this->prixTicket = $prixTicket;

        return $this;
    }

    public function getVisiteur(): ?Visiteur
    {
        return $this->visiteur;
    }

    public function setVisiteur(?Visiteur $visiteur): static
    {
        $this->visiteur = $visiteur;

        return $this;
    }

    /**
     * @return Collection<int, Voir>
     */
    public function getVues(): Collection
    {
        return $this->vues;
    }

    public function addVue(Voir $vue): static
    {
        if (!$this->vues->contains($vue)) {
            $this->vues->add($vue);
            $vue->setIdTicket($this);
        }

        return $this;
    }

    public function removeVue(Voir $vue): static
    {
        if ($this->vues->removeElement($vue)) {
            // set the owning side to null (unless already changed)
            if ($vue->getIdTicket() === $this) {
                $vue->setIdTicket(null);
            }
        }

        return $this;
    }
}
