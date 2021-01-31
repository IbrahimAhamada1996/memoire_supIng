<?php

namespace App\Entity;

use App\Repository\RetraitRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as C;

/**
 * @ORM\Entity(repositoryClass=RetraitRepository::class)
 */
class Retrait
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="retraits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codeRetrait;

    /**
     * @ORM\Column(type="boolean")
     */
    private $etatRetrait;

    /**
     * @ORM\Column(type="date")
     */
    private $dateRetrait;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomExpediteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomExpediteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phoneExpediteur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numeroPieceIdExpediteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomBeneficiaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomBeneficiaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phoneBeneficiaire;

    /**
     * @ORM\Column(type="integer")
     */
    private $tarif;

    

    public function getId(): ?int
    {
        return $this->id;
    }
     public function __toString(){
         return "".$this->etatRetrait;
     }
   
    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCodeRetrait(): ?string
    {
        return $this->codeRetrait;
    }

    public function setCodeRetrait(string $codeRetrait): self
    {
        $this->codeRetrait = $codeRetrait;

        return $this;
    }

    public function getEtatRetrait(): ?bool
    {
        return $this->etatRetrait;
    }

    public function setEtatRetrait(bool $etatRetrait): self
    {
        $this->etatRetrait = $etatRetrait;

        return $this;
    }

    public function getDateRetrait(): ?\DateTimeInterface
    {
        return $this->dateRetrait;
    }

    public function setDateRetrait(\DateTimeInterface $dateRetrait): self
    {
        $this->dateRetrait = $dateRetrait;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getNomExpediteur(): ?string
    {
        return $this->nomExpediteur;
    }

    public function setNomExpediteur(string $nomExpediteur): self
    {
        $this->nomExpediteur = $nomExpediteur;

        return $this;
    }

    public function getPrenomExpediteur(): ?string
    {
        return $this->prenomExpediteur;
    }

    public function setPrenomExpediteur(string $prenomExpediteur): self
    {
        $this->prenomExpediteur = $prenomExpediteur;

        return $this;
    }

    public function getPhoneExpediteur(): ?string
    {
        return $this->phoneExpediteur;
    }

    public function setPhoneExpediteur(string $phoneExpediteur): self
    {
        $this->phoneExpediteur = $phoneExpediteur;

        return $this;
    }

    public function getNumeroPieceIdExpediteur(): ?string
    {
        return $this->numeroPieceIdExpediteur;
    }

    public function setNumeroPieceIdExpediteur(?string $numeroPieceIdExpediteur): self
    {
        $this->numeroPieceIdExpediteur = $numeroPieceIdExpediteur;

        return $this;
    }

    public function getNomBeneficiaire(): ?string
    {
        return $this->nomBeneficiaire;
    }

    public function setNomBeneficiaire(string $nomBeneficiaire): self
    {
        $this->nomBeneficiaire = $nomBeneficiaire;

        return $this;
    }

    public function getPrenomBeneficiaire(): ?string
    {
        return $this->prenomBeneficiaire;
    }

    public function setPrenomBeneficiaire(string $prenomBeneficiaire): self
    {
        $this->prenomBeneficiaire = $prenomBeneficiaire;

        return $this;
    }

    public function getPhoneBeneficiaire(): ?string
    {
        return $this->phoneBeneficiaire;
    }

    public function setPhoneBeneficiaire(string $phoneBeneficiaire): self
    {
        $this->phoneBeneficiaire = $phoneBeneficiaire;

        return $this;
    }

    public function getTarif(): ?int
    {
        return $this->tarif;
    }

    public function setTarif(int $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }

   
}
