<?php

namespace App\Entity;

use App\Repository\VisiteurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: VisiteurRepository::class)]
class Visiteur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nomVisiteur = null;

    #[ORM\Column(length: 255)]
    private ?string $prenomVisiteur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adVisiteur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $villeVisiteur = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $telVisiteur = null;

    #[ORM\Column(length: 6)]
    private ?string $CpVisiteur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNomVisiteur(): ?string
    {
        return $this->nomVisiteur;
    }

    public function setNomVisiteur(string $nomVisiteur): static
    {
        $this->nomVisiteur = $nomVisiteur;

        return $this;
    }

    public function getPrenomVisiteur(): ?string
    {
        return $this->prenomVisiteur;
    }

    public function setPrenomVisiteur(string $prenomVisiteur): static
    {
        $this->prenomVisiteur = $prenomVisiteur;

        return $this;
    }

    public function getAdVisiteur(): ?string
    {
        return $this->adVisiteur;
    }

    public function setAdVisiteur(?string $adVisiteur): static
    {
        $this->adVisiteur = $adVisiteur;

        return $this;
    }

    public function getVilleVisiteur(): ?string
    {
        return $this->villeVisiteur;
    }

    public function setVilleVisiteur(?string $villeVisiteur): static
    {
        $this->villeVisiteur = $villeVisiteur;

        return $this;
    }

    public function getTelVisiteur(): ?string
    {
        return $this->telVisiteur;
    }

    public function setTelVisiteur(?string $telVisiteur): static
    {
        $this->telVisiteur = $telVisiteur;

        return $this;
    }

    public function getCpVisiteur(): ?string
    {
        return $this->CpVisiteur;
    }

    public function setCpVisiteur(?string $CpVisiteur): static
    {
        $this->CpVisiteur = $CpVisiteur;

        return $this;
    }
}
