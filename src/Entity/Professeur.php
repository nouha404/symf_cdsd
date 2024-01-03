<?php

namespace App\Entity;

use App\Repository\ProfesseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use App\Entity\User;

#[ORM\Entity(repositoryClass: ProfesseurRepository::class)]
class Professeur extends User
{
   
    #[ORM\Column]
    private ?bool $isArchived = null;

    #[ORM\OneToMany(mappedBy: 'professeur', targetEntity: Module::class)]
    private Collection $module;

    #[ORM\ManyToMany(targetEntity: Classe::class, inversedBy: 'professeurs')]
    #[ORM\JoinTable(name: 'professeur_classe')]
    private Collection $classe;
   

    #[ORM\ManyToMany(targetEntity: Grade::class, inversedBy: 'professeurs')]
    #[ORM\JoinTable(name: 'professeur_grade')]
    private Collection $grades;

    #[ORM\OneToMany(mappedBy: 'professeur', targetEntity: Cours::class)]
    private Collection $cours;

    #[ORM\OneToMany(mappedBy: 'professeur', targetEntity: CoursTrue::class)]
    private Collection $professeur;

    public function __construct()
    {
        $this->module = new ArrayCollection();
        $this->classe = new ArrayCollection();
        $this->grades = new ArrayCollection();
      
        $this->roles=["ROLE_PROFESSEUR"];
        $this->cours = new ArrayCollection();
        $this->professeur = new ArrayCollection();
        
    }
    

    public function setNomComplet(string $nomComplet): static
    {
        $this->nomComplet = $nomComplet;

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
     * @return Collection<int, Module>
     */
    public function getModule(): Collection
    {
        return $this->module;
    }

    public function addModule(Module $module): static
    {
        if (!$this->module->contains($module)) {
            $this->module->add($module);
            $module->setProfesseur($this);
        }

        return $this;
    }

    public function removeModule(Module $module): static
    {
        if ($this->module->removeElement($module)) {
            // set the owning side to null (unless already changed)
            if ($module->getProfesseur() === $this) {
                $module->setProfesseur(null);
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

    public function __toString()
    {
        return $this->nomComplet;
    }
    

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Grade>
     */
    public function getGrade(): Collection
    {
        return $this->grades;
    }

    public function addGrade(Grade $grade): static
    {
        if (!$this->grades->contains($grade)) {
            $this->grades->add($grade);
            $grade->setProfesseur($this);
        }

        return $this;
    }

    public function removeGrade(Grade $grade): static
    {
        if ($this->grades->removeElement($grade)) {
            // set the owning side to null (unless already changed)
            if ($grade->getProfesseur() === $this) {
                $grade->setProfesseur(null);
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
            $cour->setProfesseur($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): static
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getProfesseur() === $this) {
                $cour->setProfesseur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CoursTrue>
     */
    public function getProfesseur(): Collection
    {
        return $this->professeur;
    }

    public function addProfesseur(CoursTrue $professeur): static
    {
        if (!$this->professeur->contains($professeur)) {
            $this->professeur->add($professeur);
            $professeur->setProfesseur($this);
        }

        return $this;
    }

    public function removeProfesseur(CoursTrue $professeur): static
    {
        if ($this->professeur->removeElement($professeur)) {
            // set the owning side to null (unless already changed)
            if ($professeur->getProfesseur() === $this) {
                $professeur->setProfesseur(null);
            }
        }

        return $this;
    }
    
   


   
}
