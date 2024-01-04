<?php

namespace App\Entity;

use App\Repository\PlannificationRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;

#[ORM\Entity(repositoryClass: PlannificationRepository::class)]
class Plannification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

  
    #[ORM\Column(type: 'datetime')]
    
    private ?\DateTimeInterface $dateAt = null;

    #[ORM\Column(type:"time", nullable:true)]
    private ?\DateTimeInterface $heureDebutAt = null;

    #[ORM\Column(type:"time", nullable:true)]
    private ?\DateTimeInterface $heureFinAt = null;

    #[ORM\Column]
    private ?bool $isActived = false;

    #[ORM\Column]
    private ?bool $isEtat = false;

    #[ORM\ManyToOne(inversedBy: 'plannification')]
    private ?Cours $cours = null;

    #[ORM\ManyToOne(inversedBy: 'plannification')]
    private ?CoursTrue $plannification = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAt(): ?\DateTimeInterface
    {
        return $this->dateAt;
    }

    public function setDateAt(\DateTimeInterface $dateAt): static
    {
       
        $this->dateAt = $dateAt;

        return $this;
    }

    public function getHeureDebutAt(): ?\DateTimeInterface
    {
        return $this->heureDebutAt;
    }

    public function setHeureDebutAt(\DateTimeInterface $heureDebutAt): static
    {
       
        $this->heureDebutAt = $heureDebutAt;

        return $this;
    }

    public function getHeureFinAt(): ?\DateTimeInterface
    {
        return $this->heureFinAt;
    }

    public function setHeureFinAt(\DateTimeInterface $heureFinAt): static
    {
        
        $this->heureFinAt = $heureFinAt;

        return $this;
    }

    public function isIsActived(): ?bool
    {
        return $this->isActived;
    }

    public function setIsActived(bool $isActived): static
    {
        $this->isActived = $isActived;

        return $this;
    }

    public function isIsEtat(): ?bool
    {
        return $this->isEtat;
    }

    public function setIsEtat(bool $isEtat): static
    {
        $this->isEtat = $isEtat;

        return $this;
    }

    public function getCours(): ?Cours
    {
        return $this->cours;
    }

    public function setCours(?Cours $cours): static
    {
        $this->cours = $cours;

        return $this;
    }

    public function getPlannification(): ?CoursTrue
    {
        return $this->plannification;
    }

    public function setPlannification(?CoursTrue $plannification): static
    {
        $this->plannification = $plannification;

        return $this;
    }
}
