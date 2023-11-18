<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomFamille = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $descFamille = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFamille(): ?string
    {
        return $this->nomFamille;
    }

    public function setNomFamille(string $nomFamille): static
    {
        $this->nomFamille = $nomFamille;

        return $this;
    }

    public function getDescFamille(): ?string
    {
        return $this->descFamille;
    }

    public function setDescFamille(?string $descFamille): static
    {
        $this->descFamille = $descFamille;

        return $this;
    }
}
