<?php
namespace App\Entity;

use App\Repository\EditeurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EditeurRepository::class)]
class Editeur
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length:255)]
    private ?string $nomEditeur = null;

    #[ORM\Column(length:255)]
    private ?string $pays = null;

    #[ORM\Column(length:255)]
    private ?string $adresse = null;

    #[ORM\Column(length:50)]
    private ?string $telephone = null;

    // 👉 Nouveau champ image (nullable)
    #[ORM\Column(length:255, nullable: true)]
    private ?string $image = null;

    public function __toString(): string
    {
        return $this->nomEditeur ?? '';
    }

    // ---- GETTERS & SETTERS ----

    public function getId(): ?int { return $this->id; }

    public function getNomEditeur(): ?string { return $this->nomEditeur; }
    public function setNomEditeur(string $nomEditeur): self { $this->nomEditeur = $nomEditeur; return $this; }

    public function getPays(): ?string { return $this->pays; }
    public function setPays(string $pays): self { $this->pays = $pays; return $this; }

    public function getAdresse(): ?string { return $this->adresse; }
    public function setAdresse(string $adresse): self { $this->adresse = $adresse; return $this; }

    public function getTelephone(): ?string { return $this->telephone; }
    public function setTelephone(string $telephone): self { $this->telephone = $telephone; return $this; }

    public function getImage(): ?string { return $this->image; }
    public function setImage(?string $image): self { $this->image = $image; return $this; }
}
