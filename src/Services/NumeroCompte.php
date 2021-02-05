<?php

namespace App\Services;

class NumeroCompte{

    public function numero()
    {
        $lettre = "SM-";
        $entier = rand(0,9);
        $h = date("H");
        $min = date("i");
        $sec =date("s"); 
        $code = "$lettre$h $entier$min $sec";
        

        return $code;
    }
}