<?php

namespace App\Entity;

use App\Repository\SemestreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SemestreRepository::class)]
class Semestre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'semestre', targetEntity: Cours::class)]
    private Collection $cours;

    #[ORM\ManyToOne(inversedBy: 'semestres')]
    private ?Niveau $niveau = null;

    #[ORM\OneToMany(mappedBy: 'semestre', targetEntity: CoursTrue::class)]
    private Collection $semestre;

    public function __construct()
    {
        $this->cours = new ArrayCollection();
        $this->semestre = new ArrayCollection();
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
            $cour->setSemestre($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): static
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getSemestre() === $this) {
                $cour->setSemestre(null);
            }
        }

        return $this;
    }

    public function getNiveau(): ?Niveau
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveau $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * @return Collection<int, CoursTrue>
     */
    public function getSemestre(): Collection
    {
        return $this->semestre;
    }

    public function addSemestre(CoursTrue $semestre): static
    {
        if (!$this->semestre->contains($semestre)) {
            $this->semestre->add($semestre);
            $semestre->setSemestre($this);
        }

        return $this;
    }

    public function removeSemestre(CoursTrue $semestre): static
    {
        if ($this->semestre->removeElement($semestre)) {
            // set the owning side to null (unless already changed)
            if ($semestre->getSemestre() === $this) {
                $semestre->setSemestre(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->libelle; 
    }

}
