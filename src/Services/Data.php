<?php
namespace App\Services;

class Data{

    private $donnes=[];
    public function __construct()
    {
        
    }

    public function eleves($variable)
    {
        foreach ($variable as $key => $value) {
            
            foreach ($value as $key => $value) {
                $this->donnes[$key] = $value;
            }
        }   
            
        return $this->donnes;
    }
}