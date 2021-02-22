<?php
namespace App\Entity;

class VilleSearch{
 
    /**
     * ville
     *
     * @var mixed
     */
    private $ville;

    public function getVille():string
    {
        return $this->ville;
    }

    public function setVille(string $ville): void
    {
        $this->ville = $ville;
    }

}