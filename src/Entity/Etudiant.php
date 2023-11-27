<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\EtudiantRepository;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
class Etudiant extends User
{
    public function __construct(){
        $this->roles=["ROLE_ETUDIANT"];
        $this->inscriptions = new ArrayCollection();
    }
    
   

    #[ORM\Column(length: 255)]
    private ?string $matricule = null;

    #[ORM\Column(length: 255)]
    private ?string $tuteur = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateNaissanceAt = null;

    #[ORM\OneToMany(mappedBy: 'etudiant', targetEntity: Inscription::class)]
    private Collection $inscriptions;

  
    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): static
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getTuteur(): ?string
    {
        return $this->tuteur;
    }

    public function setTuteur(string $tuteur): static
    {
        $this->tuteur = $tuteur;

        return $this;
    }

    public function getDateNaissanceAt(): ?\DateTimeImmutable
    {
        return $this->dateNaissanceAt;
    }

    public function setDateNaissanceAt(\DateTimeImmutable $dateNaissanceAt): static
    {
        $this->dateNaissanceAt = $dateNaissanceAt;

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
            $inscription->setEtudiant($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): static
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getEtudiant() === $this) {
                $inscription->setEtudiant(null);
            }
        }

        return $this;
    }
}
