<?php

namespace App\Entity;

use App\Repository\AnneScolaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnneScolaireRepository::class)]
class AnneScolaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\OneToMany(mappedBy: 'anneScolaire', targetEntity: Inscription::class)]
    private Collection $inscriptions;

    #[ORM\OneToMany(mappedBy: 'anneScolaire', targetEntity: Cours::class)]
    private Collection $cours;

    #[ORM\OneToMany(mappedBy: 'anneScolaire', targetEntity: CoursTrue::class)]
    private Collection $annescolaire;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
        $this->cours = new ArrayCollection();
        $this->annescolaire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection<int, Inscription>
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): static
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions->add($inscription);
            $inscription->setAnneScolaire($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): static
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getAnneScolaire() === $this) {
                $inscription->setAnneScolaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Cours>
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Cours $cour): static
    {
        if (!$this->cours->contains($cour)) {
            $this->cours->add($cour);
            $cour->setAnneScolaire($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): static
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getAnneScolaire() === $this) {
                $cour->setAnneScolaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CoursTrue>
     */
    public function getAnnescolaire(): Collection
    {
        return $this->annescolaire;
    }

    public function addAnnescolaire(CoursTrue $annescolaire): static
    {
        if (!$this->annescolaire->contains($annescolaire)) {
            $this->annescolaire->add($annescolaire);
            $annescolaire->setAnneScolaire($this);
        }

        return $this;
    }

    public function removeAnnescolaire(CoursTrue $annescolaire): static
    {
        if ($this->annescolaire->removeElement($annescolaire)) {
            // set the owning side to null (unless already changed)
            if ($annescolaire->getAnneScolaire() === $this) {
                $annescolaire->setAnneScolaire(null);
            }
        }

        return $this;
    }
}
