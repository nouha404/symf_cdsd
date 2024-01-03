<?php

namespace App\Entity;

use App\Repository\PlannificationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlannificationRepository::class)]
class Plannification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $heureDebutAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $heureFinAt = null;

    #[ORM\Column]
    private ?bool $isActived = null;

    #[ORM\Column]
    private ?bool $isEtat = null;

    #[ORM\ManyToOne(inversedBy: 'plannification')]
    private ?Cours $cours = null;

    #[ORM\ManyToOne(inversedBy: 'plannification')]
    private ?CoursTrue $plannification = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAt(): ?\DateTimeImmutable
    {
        return $this->dateAt;
    }

    public function setDateAt(\DateTimeImmutable $dateAt): static
    {
        $this->dateAt = $dateAt;

        return $this;
    }

    public function getHeureDebutAt(): ?\DateTimeImmutable
    {
        return $this->heureDebutAt;
    }

    public function setHeureDebutAt(\DateTimeImmutable $heureDebutAt): static
    {
        $this->heureDebutAt = $heureDebutAt;

        return $this;
    }

    public function getHeureFinAt(): ?\DateTimeImmutable
    {
        return $this->heureFinAt;
    }

    public function setHeureFinAt(\DateTimeImmutable $heureFinAt): static
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
