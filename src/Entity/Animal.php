<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idAnimal = null;

    #[ORM\Column]
    private ?int $idCategorie = null;

    #[ORM\Column]
    private ?int $idEnclos = null;

    #[ORM\Column]
    private ?int $idFamille = null;

    #[ORM\Column(length: 50)]
    private ?string $nomAnimal = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $descAnimal = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $imgAnimal = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdAnimal(): ?int
    {
        return $this->idAnimal;
    }

    public function setIdAnimal(int $idAnimal): static
    {
        $this->idAnimal = $idAnimal;

        return $this;
    }

    public function getIdCategorie(): ?int
    {
        return $this->idCategorie;
    }

    public function setIdCategorie(int $idCategorie): static
    {
        $this->idCategorie = $idCategorie;

        return $this;
    }

    public function getIdEnclos(): ?int
    {
        return $this->idEnclos;
    }

    public function setIdEnclos(int $idEnclos): static
    {
        $this->idEnclos = $idEnclos;

        return $this;
    }

    public function getIdFamille(): ?int
    {
        return $this->idFamille;
    }

    public function setIdFamille(int $idFamille): static
    {
        $this->idFamille = $idFamille;

        return $this;
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

    public function getImgAnimal()
    {
        return $this->imgAnimal;
    }

    public function setImgAnimal($imgAnimal): static
    {
        $this->imgAnimal = $imgAnimal;

        return $this;
    }
}
