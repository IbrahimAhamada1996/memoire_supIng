<?php

namespace App\Entity;

use App\Repository\EtatRetraitRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtatRetraitRepository::class)
 */
class EtatRetrait
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $etat;

    /**
     * @ORM\OneToOne(targetEntity=Retrait::class, inversedBy="etatRetrait", cascade={"persist", "remove"})
     */
    private $retrait;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getRetrait(): ?Retrait
    {
        return $this->retrait;
    }

    public function setRetrait(?Retrait $retrait): self
    {
        $this->retrait = $retrait;

        return $this;
    }
}
