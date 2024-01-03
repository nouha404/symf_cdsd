<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
class Inscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createAt = null ;

    #[ORM\Column]
    private ?bool $isArchived = false;

    #[ORM\ManyToOne(inversedBy: 'inscriptions',cascade:["persist"])]
    private ?Etudiant $etudiant = null;

    #[ORM\ManyToOne(inversedBy: 'inscriptions')]
    private ?Classe $classe = null;

    #[ORM\ManyToOne(inversedBy: 'inscriptions')]
    private ?AnneScolaire $anneScolaire = null;


    public function __construct()
    {
        $this->createAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeImmutable $createAt): static
    {
        $this->createAt = $createAt;

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

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): static
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): static
    {
        $this->classe = $classe;

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
}
