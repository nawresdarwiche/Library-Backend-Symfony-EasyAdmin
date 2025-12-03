<?php
namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: LivreRepository::class)]
class Livre
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length:255)]
    private ?string $titre = null;

    #[ORM\Column]
    private ?int $nbPages = null;

   #[ORM\Column(length: 10)]
private ?string $dateEdition = null;

public function getDateEdition(): ?string
{
    return $this->dateEdition;
}

public function setDateEdition(?string $dateEdition): self
{
    $this->dateEdition = $dateEdition;
    return $this;
}
    #[ORM\Column]
    private ?int $nbExemplaires = null;

    #[ORM\Column(type: 'float')]
    private ?float $prix = null;

    #[ORM\Column(length: 50)]
    private ?string $isbn = null;

    #[ORM\ManyToOne(targetEntity: Editeur::class)]
    private ?Editeur $editeur = null;

    #[ORM\ManyToOne(targetEntity: Categorie::class)]
    private ?Categorie $categorie = null;

    #[ORM\ManyToMany(targetEntity: Auteur::class, inversedBy: 'livres')]
    private Collection $auteurs;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    public function __construct()
    {
        $this->auteurs = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->titre ?? '';
    }

    // ---------- GETTERS / SETTERS ----------

    public function getId(): ?int { return $this->id; }

    public function getTitre(): ?string { return $this->titre; }
    public function setTitre(string $titre): self { $this->titre = $titre; return $this; }

    public function getNbPages(): ?int { return $this->nbPages; }
    public function setNbPages(int $nbPages): self { $this->nbPages = $nbPages; return $this; }


    public function getNbExemplaires(): ?int { return $this->nbExemplaires; }
    public function setNbExemplaires(int $nbExemplaires): self { $this->nbExemplaires = $nbExemplaires; return $this; }

    public function getPrix(): ?float { return $this->prix; }
    public function setPrix(float $prix): self { $this->prix = $prix; return $this; }

    public function getIsbn(): ?string { return $this->isbn; }
    public function setIsbn(string $isbn): self { $this->isbn = $isbn; return $this; }

    public function getEditeur(): ?Editeur { return $this->editeur; }
    public function setEditeur(?Editeur $editeur): self { $this->editeur = $editeur; return $this; }

    public function getCategorie(): ?Categorie { return $this->categorie; }
    public function setCategorie(?Categorie $categorie): self { $this->categorie = $categorie; return $this; }

    // ---------- Gestion ManyToMany auteurs ----------
    public function getAuteurs(): Collection { return $this->auteurs; }

    public function addAuteur(Auteur $auteur): self
    {
        if (!$this->auteurs->contains($auteur)) {
            $this->auteurs->add($auteur);
        }
        return $this;
    }

    public function removeAuteur(Auteur $auteur): self
    {
        $this->auteurs->removeElement($auteur);
        return $this;
    }

    // ---------- Image ----------
    public function getImage(): ?string { return $this->image; }
    public function setImage(?string $image): self { $this->image = $image; return $this; }
}
