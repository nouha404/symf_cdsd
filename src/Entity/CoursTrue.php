<?php

namespace App\Entity;

use App\Repository\CoursTrueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursTrueRepository::class)]
class CoursTrue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $nombreHeureEffAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $nombreHeureGlobalAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $nombreHeurePlannifierAt = null;

    #[ORM\OneToMany(mappedBy: 'plannification', targetEntity: Plannification::class)]
    private Collection $plannification;

    #[ORM\ManyToMany(targetEntity: Classe::class, inversedBy: 'classe')]
    private Collection $classe;

    #[ORM\ManyToOne(inversedBy: 'professeur')]
    private ?Professeur $professeur = null;

    #[ORM\ManyToOne(inversedBy: 'module')]
    private ?Module $module = null;

    #[ORM\ManyToOne(inversedBy: 'annescolaire')]
    private ?AnneScolaire $anneScolaire = null;

    #[ORM\ManyToOne(inversedBy: 'semestre')]
    private ?Semestre $semestre = null;

    public function __construct()
    {
        $this->plannification = new ArrayCollection();
        $this->classe = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreHeureEffAt(): ?\DateTimeImmutable
    {
        return $this->nombreHeureEffAt;
    }

    public function setNombreHeureEffAt(?\DateTimeImmutable $nombreHeureEffAt): static
    {
        $this->nombreHeureEffAt = $nombreHeureEffAt;

        return $this;
    }

    public function getNombreHeureGlobalAt(): ?\DateTimeImmutable
    {
        return $this->nombreHeureGlobalAt;
    }

    public function setNombreHeureGlobalAt(?\DateTimeImmutable $nombreHeureGlobalAt): static
    {
        $this->nombreHeureGlobalAt = $nombreHeureGlobalAt;

        return $this;
    }

    public function getNombreHeurePlannifierAt(): ?\DateTimeImmutable
    {
        return $this->nombreHeurePlannifierAt;
    }

    public function setNombreHeurePlannifierAt(?\DateTimeImmutable $nombreHeurePlannifierAt): static
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
            $plannification->setPlannification($this);
        }

        return $this;
    }

    public function removePlannification(Plannification $plannification): static
    {
        if ($this->plannification->removeElement($plannification)) {
            // set the owning side to null (unless already changed)
            if ($plannification->getPlannification() === $this) {
                $plannification->setPlannification(null);
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

    public function getProfesseur(): ?Professeur
    {
        return $this->professeur;
    }

    public function setProfesseur(?Professeur $professeur): static
    {
        $this->professeur = $professeur;

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

    public function getAnneScolaire(): ?AnneScolaire
    {
        return $this->anneScolaire;
    }

    public function setAnneScolaire(?AnneScolaire $anneScolaire): static
    {
        $this->anneScolaire = $anneScolaire;

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
}
