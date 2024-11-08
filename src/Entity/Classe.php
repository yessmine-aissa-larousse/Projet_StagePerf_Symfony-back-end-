<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
#[Broadcast]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Niveau = null;

    #[ORM\Column]
    private ?int $nb_eleves = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNiveau(): ?string
    {
        return $this->Niveau;
    }

    public function setNiveau(string $Niveau): static
    {
        $this->Niveau = $Niveau;

        return $this;
    }

    public function getNbEleves(): ?int
    {
        return $this->nb_eleves;
    }

    public function setNbEleves(int $nb_eleves): static
    {
        $this->nb_eleves = $nb_eleves;

        return $this;
    }
}
