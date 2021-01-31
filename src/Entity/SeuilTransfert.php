<?php

namespace App\Entity;

use App\Repository\SeuilTransfertRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SeuilTransfertRepository::class)
 */
class SeuilTransfert
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $min;

    /**
     * @ORM\Column(type="float")
     */
    private $max;

    /**
     * @ORM\OneToMany(targetEntity=Transfert::class, mappedBy="seuilTransfert")
     */
    private $transfert;

    public function __construct()
    {
        $this->transfert = new ArrayCollection();
    }
    public function __toString(){
        return "".$this->min;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMin(): ?float
    {
        return $this->min;
    }

    public function setMin(float $min): self
    {
        $this->min = $min;

        return $this;
    }

    public function getMax(): ?float
    {
        return $this->max;
    }

    public function setMax(float $max): self
    {
        $this->max = $max;

        return $this;
    }

    /**
     * @return Collection|Transfert[]
     */
    public function getTransfert(): Collection
    {
        return $this->transfert;
    }

    public function addTransfert(Transfert $transfert): self
    {
        if (!$this->transfert->contains($transfert)) {
            $this->transfert[] = $transfert;
            $transfert->setSeuilTransfert($this);
        }

        return $this;
    }

    public function removeTransfert(Transfert $transfert): self
    {
        if ($this->transfert->removeElement($transfert)) {
            // set the owning side to null (unless already changed)
            if ($transfert->getSeuilTransfert() === $this) {
                $transfert->setSeuilTransfert(null);
            }
        }

        return $this;
    }
}
