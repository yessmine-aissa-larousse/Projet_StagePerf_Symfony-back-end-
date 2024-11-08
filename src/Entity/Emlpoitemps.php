<?php

namespace App\Entity;

use App\Repository\EmlpoitempsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

use App\Entity\Formateur;
use App\Entity\Classe;
use App\Entity\Salle;

#[ORM\Entity(repositoryClass: EmlpoitempsRepository::class)]
#[Broadcast]
class Emlpoitemps
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private  $id ;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private  $date_jour ;

    #[ORM\Column(type: 'integer')]
    private  $debut ;

    #[ORM\Column(type: 'integer')]
    private  $fin ;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateJour(): ?\DateTimeInterface
    {
        return $this->date_jour;
    }

    public function setDateJour(\DateTimeInterface $date_jour): static
    {
        $this->date_jour = $date_jour;

        return $this;
    }

    public function getDebut(): ?int
    {
        return $this->debut;
    }

    public function setDebut(int $debut): static
    {
        $this->debut = $debut;

        return $this;
    }

    public function getFin(): ?int
    {
        return $this->fin;
    }

    public function setFin(int $fin): static
    {
        $this->fin = $fin;

        return $this;
    }


    #[ORM\ManyToOne(targetEntity: Classe::class)]
    #[ORM\JoinColumn(name: 'idcl', referencedColumnName: 'id')]
    private ?Classe $idcl;
    public function getClasse(): ?Classe
    {
        return $this->idcl;
    }

    public function setClasse(?Classe $idcl): self
    {
        $this->idcl = $idcl;

        return $this;
    }

    #[ORM\ManyToOne(targetEntity: Salle::class)]
    #[ORM\JoinColumn(name: 'idsl', referencedColumnName: 'id')]
    private ?Salle $idsl;
    public function getSalle(): ?Salle
    {
        return $this->idsl;
    }

    public function setSalle(?Salle $idsl): self
    {
        $this->idsl = $idsl;

        return $this;
    }

    #[ORM\ManyToOne(targetEntity: Formateur::class)]
    #[ORM\JoinColumn(name: 'idform', referencedColumnName: 'codef')]
    private ?Formateur $idform;
    public function getFormateur(): ?Formateur
    {
        return $this->idform;
    }

    public function setFormateur(?Formateur $idform): self
    {
        $this->idform = $idform;

        return $this;
    }
}
