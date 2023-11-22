<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomAnimal = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $descAnimal = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    private ?Famille $idFamille = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    private ?Categorie $idCategorie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAnimal(): ?string
    {
        return $this->nomAnimal;
    }

    public function setNomAnimal(string $nomAnimal): static
    {
        $this->nomAnimal = $nomAnimal;

        return $this;
    }

    public function getDescAnimal(): ?string
    {
        return $this->descAnimal;
    }

    public function setDescAnimal(?string $descAnimal): static
    {
        $this->descAnimal = $descAnimal;

        return $this;
    }

    public function getIdFamille(): ?Famille
    {
        return $this->idFamille;
    }

    public function setIdFamille(?Famille $idFamille): static
    {
        $this->idFamille = $idFamille;

        return $this;
    }

    /**
     * @return Categorie|null
     */
    public function getIdCategorie(): ?Categorie
    {
        return $this->idCategorie;
    }

    /**
     * @param Categorie|null $idCategorie
     */
    public function setIdCategorie(?Categorie $idCategorie): static
    {
        $this->idCategorie = $idCategorie;

        return $this;
    }
}
