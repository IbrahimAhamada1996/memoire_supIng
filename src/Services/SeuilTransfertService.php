<?php

namespace App\Services;

use App\Entity\SeuilTransfert;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SeuilTransfertService{

    /**
     * @var ContainerInterface
     */
    private $container;
   

    public function __construct(ContainerInterface $container){
       $this->container = $container;
      
    
    }
    private function container(){
        $em = $this->container->get('doctrine.orm.entity_manager');
        return $em;
    }

    public function seuil()
    {
       $seuitTransferts = $this->container()->getRepository(SeuilTransfert::class)->findAll();
       
        
        foreach ($seuitTransferts as $key => $value) {
            $seuitTransferts = $value;
        }
       return $seuitTransferts;
    }
}