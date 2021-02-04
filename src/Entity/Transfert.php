<?php

namespace App\Entity;

use App\Validator\Constraints as SeuilAssert;
use App\Entity\SeuilTransfert;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TransfertRepository;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as MyAssert;

/**
 * @ORM\Entity(repositoryClass=TransfertRepository::class)
 */
class Transfert
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $villeEnvoi;

    /**
     * 
     * @SeuilAssert\SeuilGenerale
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Le nom doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le nom ne peut pas comporter plus de {{ limit }} caractères"
     * )
     */
    private $nomExpediteur;

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Le prenom doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le prénom ne peut pas comporter plus de {{ limit }} caractères"
     * )
     */
    private $prenomExpediteur;

    /**
     * @ORM\Column(type="string", length=255)
     * @MyAssert\Tel
     */
    private $phoneExpediteur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numeroPieceId;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Le nom doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le nom ne peut pas comporter plus de {{ limit }} caractères"
     * )
     */
    private $nomBeneficiaire;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Le prenom doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le prénom ne peut pas comporter plus de {{ limit }} caractères"
     * )
     */
    private $prenomBeneficiaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codeTransfert;

    
    /**
     * @ORM\Column(type="boolean")
     */
    private $etatTransfert = false;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="transferts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=SeuilTransfert::class, inversedBy="transfert")
     */
    private $seuilTransfert;

    /**
     * @ORM\Column(type="string", length=255)
     * @MyAssert\Tel
     */
    private $phoneBeneficiaire;

    /**
     * @ORM\ManyToOne(targetEntity=Tarif::class, inversedBy="transferts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tarif;

    /**
     * @ORM\Column(type="date")
     */
    private $dateTransfert;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function __toString(){
        return $this->tarif;
    }

    public function getVilleEnvoi(): ?string
    {
        return $this->villeEnvoi;
    }

    public function setVilleEnvoi(string $villeEnvoi): self
    {
        $this->villeEnvoi = $villeEnvoi;

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

    public function getNumeroPieceId(): ?string
    {
        return $this->numeroPieceId;
    }

    public function setNumeroPieceId(?string $numeroPieceId): self
    {
        $this->numeroPieceId = $numeroPieceId;

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

    public function getCodeTransfert(): ?string
    {
        return $this->codeTransfert;
    }

    public function setCodeTransfert(string $codeTransfert): self
    {
        $this->codeTransfert = $codeTransfert;

        return $this;
    }

    

    public function getEtatTransfert(): ?bool
    {
        return $this->etatTransfert;
    }

    public function setEtatTransfert(bool $etatTransfert): self
    {
        $this->etatTransfert = $etatTransfert;

        return $this;
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

    public function getSeuilTransfert(): ?SeuilTransfert
    {
        return $this->seuilTransfert;
    }

    public function setSeuilTransfert(?SeuilTransfert $seuilTransfert): self
    {
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

    public function getTarif(): ?Tarif
    {
        return $this->tarif;
    }

    public function setTarif(?Tarif $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }

    public function getDateTransfert(): ?\DateTimeInterface
    {
        return $this->dateTransfert;
    }

    public function setDateTransfert(\DateTimeInterface $dateTransfert): self
    {
        $this->dateTransfert = $dateTransfert;

        return $this;
    }


    
}
