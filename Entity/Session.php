<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SessionRepository")
 */
class Session
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $effectif;

    /**
     * @ORM\Column(type="boolean")
     */
    private $complet;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cours", inversedBy="sessions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Cours;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEffectif(): ?int
    {
        return $this->effectif;
    }

    public function setEffectif(int $effectif): self
    {
        $this->effectif = $effectif;

        return $this;
    }

    public function getComplet(): ?bool
    {
        return $this->complet;
    }

    public function setComplet(bool $complet): self
    {
        $this->complet = $complet;

        return $this;
    }

    public function getCours(): ?Cours
    {
        return $this->Cours;
    }

    public function setCours(?Cours $Cours): self
    {
        $this->Cours = $Cours;

        return $this;
    }
}
