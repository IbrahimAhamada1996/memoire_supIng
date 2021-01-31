<?php

namespace App\Services;

use App\Entity\Tarif;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MontantService{

    private $montant;
    private $benefice;
    private $tabMin = [];
    private $tabMax = [];
    private $tabTarif = [];

    
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container){
       $this->container = $container;
    
    }

   
    public function montantRecu($montant){

        $em = $this->container->get('doctrine.orm.entity_manager');
        $items = $em->getRepository(Tarif::class)->findAll();
        
        foreach ($items as $key => $value) {
            
            $this->tabMin[$key] = $value->getMin();
            $this->tabMax[$key] = $value->getMax();
            $this->tabTarif[$key] = $value->getTarifClient();

            if ($montant >= $value->getMin() && $montant <= $value->getMax()) {
        
               $this->montant = $montant - $this->tabTarif[$key];
               $this->benefice = $this->tabTarif[$key] ;
               $this->id = $key;
               
            }
        }

        return $this->montant;

    }

    public function tarif(){
        
        return (int) $this->benefice;
    }
    public function id(){
        return $this->id;
    }
    
}