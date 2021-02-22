<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Validator\Constraints as C;
use App\Repository\CompteRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CompteRepository::class)
 * @UniqueEntity(
 *     fields={"numeroCompte"},
 *     errorPath="numeroCompte",
 *     message="Ce numero de compte existe déja, Veuillez réessayer!!"
 * )
 */
class Compte
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Positive
     * 
     */
    private $solde;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="compte", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numeroCompte;
    
    public function __construct()
    {
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function __toString(){
        return "N° Compte: $this->numeroCompte | $this->user";
    }

    public function getSolde(): ?float
    {
        return $this->solde;
    }

    public function setSolde(?float $solde,$benefice=null): self
    {
        if (1 == $benefice) {
            $this->solde = $solde;
           
        }
        if(null==$benefice) {
            $this->solde += $solde;
        }
       
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNumeroCompte(): ?string
    {
        return $this->numeroCompte;
    }

    public function setNumeroCompte(string $numeroCompte): self
    {
        $this->numeroCompte = $numeroCompte;

        return $this;
    }
}
