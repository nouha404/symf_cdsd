<?php

namespace App\Entity;

use App\Repository\ModuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModuleRepository::class)]
class Module
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $libelle = null;

    #[ORM\ManyToOne(inversedBy: 'module')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Professeur $professeur = null;

    #[ORM\Column]
    private ?bool $isArchived = null;

    #[ORM\ManyToMany(targetEntity: Classe::class, mappedBy: 'module')]
    private Collection $classes;

    #[ORM\OneToMany(mappedBy: 'module', targetEntity: Cours::class)]
    private Collection $cours;

    #[ORM\OneToMany(mappedBy: 'module', targetEntity: CoursTrue::class)]
    private Collection $module;

    public function __construct()
    {
        $this->classes = new ArrayCollection();
        $this->cours = new ArrayCollection();
        $this->module = new ArrayCollection();
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

    public function getProfesseur(): ?Professeur
    {
        return $this->professeur;
    }

    public function setProfesseur(?Professeur $professeur): static
    {
        $this->professeur = $professeur;

        return $this;
    }

    public function isIsArchived(): ?bool
    {
        return $this->isArchived;
    }

    public function setIsArchived(bool $isArchived): static
    {
        $this->isArchived = $isArchived;

        return $this;
    }

    /**
     * @return Collection<int, Classe>
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(Classe $class): static
    {
        if (!$this->classes->contains($class)) {
            $this->classes->add($class);
            $class->addModule($this);
        }

        return $this;
    }

    public function removeClass(Classe $class): static
    {
        if ($this->classes->removeElement($class)) {
            $class->removeModule($this);
        }

        return $this;
    }
    public function __toString()
    {
        return $this->libelle;
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
            $cour->setModule($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): static
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getModule() === $this) {
                $cour->setModule(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CoursTrue>
     */
    public function getModule(): Collection
    {
        return $this->module;
    }

    public function addModule(CoursTrue $module): static
    {
        if (!$this->module->contains($module)) {
            $this->module->add($module);
            $module->setModule($this);
        }

        return $this;
    }

    public function removeModule(CoursTrue $module): static
    {
        if ($this->module->removeElement($module)) {
            // set the owning side to null (unless already changed)
            if ($module->getModule() === $this) {
                $module->setModule(null);
            }
        }

        return $this;
    }
}
