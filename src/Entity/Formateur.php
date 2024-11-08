<?php

namespace App\Entity;

use App\Repository\FormateurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: FormateurRepository::class)]
#[Broadcast]
class Formateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column ( name:'codef' , type:'integer') ]
    private  $id ;

    #[ORM\Column(length: 30 , type:'string' , name:'nom' )]
    private $nom;

    #[ORM\Column(length: 30 , type:'string' , name:'prenom' )]
    private  $prénom;

    #[ORM\Column(length: 30 , type:'string' , name:'mail' )]
    private  $mail;

    #[ORM\Column ( name:'tel')]
    private $tel;

    #[ORM\Column(length: 30 , type:'string' , name:'adresse' )]
    private $adresse;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prénom;
    }

    public function setPrenom(?string $prénom): self
    {
        $this->prénom = $prénom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(?int $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }
}
