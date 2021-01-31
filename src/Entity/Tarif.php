<?php

namespace App\Entity;

use App\Repository\TarifRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TarifRepository::class)
 */
class Tarif
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     */
    private $min;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     */
    private $max;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     */
    private $tarifClient;

    /**
     * @ORM\OneToMany(targetEntity=Transfert::class, mappedBy="tarif", orphanRemoval=true)
     */
    private $transferts;

    public function __construct()
    {
        $this->transferts = new ArrayCollection();
    }

    public function __toString(){
        return $this->min." - ".$this->max;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMin(): ?int
    {
        return $this->min;
    }

    public function setMin(int $min): self
    {
        $this->min = $min;

        return $this;
    }

    public function getMax(): ?int
    {
        return $this->max;
    }

    public function setMax(int $max): self
    {
        $this->max = $max;

        return $this;
    }

    public function getTarifClient(): ?int
    {
        return $this->tarifClient;
    }

    public function setTarifClient(int $tarifClient): self
    {
        $this->tarifClient = $tarifClient;

        return $this;
    }

    /**
     * @return Collection|Transfert[]
     */
    public function getTransferts(): Collection
    {
        return $this->transferts;
    }

    public function addTransfert(Transfert $transfert): self
    {
        if (!$this->transferts->contains($transfert)) {
            $this->transferts[] = $transfert;
            $transfert->setTarif($this);
        }

        return $this;
    }

    public function removeTransfert(Transfert $transfert): self
    {
        if ($this->transferts->removeElement($transfert)) {
            // set the owning side to null (unless already changed)
            if ($transfert->getTarif() === $this) {
                $transfert->setTarif(null);
            }
        }

        return $this;
    }
}
