<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $nombreHeureEffAt = null;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $nombreHeureGlobalAt = null;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $nombreHeurePlannifierAt = null;

    #[ORM\OneToMany(mappedBy: 'cours', targetEntity: Plannification::class)]
    private Collection $plannification;

    #[ORM\ManyToMany(targetEntity: Classe::class, inversedBy: 'cours')]
    private Collection $classe;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    private ?AnneScolaire $anneScolaire = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    private ?Professeur $professeur = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    private ?Semestre $semestre = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    private ?Module $module = null;

    public function __construct()
    {
        $this->plannification = new ArrayCollection();
        $this->classe = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreHeureEffAt(): ?\DateTimeInterface
    {
        
        return $this->nombreHeureEffAt;
    }

    public function setNombreHeureEffAt(?\DateTimeInterface $nombreHeureEffAt): static
    {
        $this->nombreHeureEffAt = $nombreHeureEffAt;
    
        return $this;
    }

    public function getNombreHeureGlobalAt(): ?\DateTimeInterface
    {
        return $this->nombreHeureGlobalAt;
    }

    public function setNombreHeureGlobalAt(?\DateTimeInterface $nombreHeureGlobalAt): static
    {
        $this->nombreHeureGlobalAt = $nombreHeureGlobalAt;

        return $this;
    }

    public function getNombreHeurePlannifierAt(): ?\DateTimeInterface
    {
        return $this->nombreHeurePlannifierAt;
    }

    public function setNombreHeurePlannifierAt(?\DateTimeInterface $nombreHeurePlannifierAt): static
    {
        $this->nombreHeurePlannifierAt = $nombreHeurePlannifierAt;

        return $this;
    }

    /**
     * @return Collection<int, Plannification>
     */
    public function getPlannification(): Collection
    {
        return $this->plannification;
    }

    public function addPlannification(Plannification $plannification): static
    {
        if (!$this->plannification->contains($plannification)) {
            $this->plannification->add($plannification);
            $plannification->setCours($this);
        }

        return $this;
    }

    public function removePlannification(Plannification $plannification): static
    {
        if ($this->plannification->removeElement($plannification)) {
            // set the owning side to null (unless already changed)
            if ($plannification->getCours() === $this) {
                $plannification->setCours(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Classe>
     */
    public function getClasse(): Collection
    {
        return $this->classe;
    }

    public function addClasse(Classe $classe): static
    {
        if (!$this->classe->contains($classe)) {
            $this->classe->add($classe);
        }

        return $this;
    }

    public function removeClasse(Classe $classe): static
    {
        $this->classe->removeElement($classe);

        return $this;
    }

    public function getAnneScolaire(): ?AnneScolaire
    {
        return $this->anneScolaire;
    }

    public function setAnneScolaire(?AnneScolaire $anneScolaire): static
    {
        $this->anneScolaire = $anneScolaire;

        return $this;
    }

    public function getProfesseur(): ?Professeur
    {
        return $this->professeur;
    }

    public function setProfesseur(?Professeur $professeur): static
    {
        $this->professeur = $professeur;

        return $this;
    }

    public function getSemestre(): ?Semestre
    {
        return $this->semestre;
    }

    public function setSemestre(?Semestre $semestre): static
    {
        $this->semestre = $semestre;

        return $this;
    }

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(?Module $module): static
    {
        $this->module = $module;

        return $this;
    }
}
