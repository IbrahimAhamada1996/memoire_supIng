<?php
namespace App\Services;

class CodeGenerate{

    public function __construct(){

    }

    public function generate(){
      
        $int = rand(0,9);
        $h = date("H");
        $min = date("i");
        $sec =date("s"); 

        $code = "$int$h$min$sec";
        
        return (string)$code;
    }

}