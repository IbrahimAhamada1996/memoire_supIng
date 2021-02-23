<?php

namespace App\Services;

class NumeroAgenceService{

    public function numeroAgence()
    {
        $lettre = "SM-AG-";
        $entier = rand(0,9);
        $h = date("H");
        $min = date("i");
        $sec =date("s"); 
        $code = "$lettre$h $entier$min $sec";
        

        return $code;
    }
}