<?php

namespace App\Services;

use App\Entity\Tarif;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;


class BeneficeService {

    private $beneficeTransfert_agent ;
    private $beneficeRetrait_agent;
    private $beneficeTransfert_operateur;
    private $beneficeRetrait_operateur;
    private $tarif;
    private $key;
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

   
    // public function tarif($montant){

    //     $em = $this->container->get('doctrine.orm.entity_manager');
    //     $items = $em->getRepository(Tarif::class)->findAll();
        
    //     foreach ($items as $key => $value) {
            
    //         $this->tabMin[$key] = $value->getMin();
    //         $this->tabMax[$key] = $value->getMax();
    //         $this->tabTarif[$key] = $value->getTarifClient();

    //         if ($montant >= $value->getMin() && $montant <= $value->getMax()) {
        
    //            $this->montant = $montant - $this->tabTarif[$key];
    //            $this->tarif = $this->tabTarif[$key] ;
    //            $this->id = $key;
               
    //         }
    //     }

    //     return (int) $this->tarif;

    // }

    public function container(){
        $em = $this->container->get('doctrine.orm.entity_manager');
        return $em;
    }

    public function tarif($montant){
        
        $tarifs = $this->container()->getRepository(Tarif::class)->findAll();
       
        foreach ($tarifs as $key => $value) {
            
            if ($montant >= $value->getMin() && $montant <= $value->getMax()) {
               $this->tarif = $value->getTarifClient() ;
               $this->key = $key;
            }
        }
        //    dd($this->tarif);
        return (float)$this->tarif;
    }

    public function benefice(){
        $users = $this->container()->getRepository(User::class)->findAll();
        // dd($users);
        foreach ($users as $key => $value) {
            
            if ($value->getChoiceroles()== "ROLE_OPERATEUR") {
                $this->beneficeTransfert_agent = $this->tarif * 20/100;
                $this->beneficeRetrait_agent = $this->tarif * 30/100;
            }elseif ($value->getChoiceroles() == "ROLE_SUPER_ADMIN") {
                $this->beneficeTransfert_operateur = $this->tarif * 20/100;
                $this->beneficeRetrait_operateur = $this->tarif * 30/100;
            }
        }
        
        
    }

    public function tabBenefice($montant){
        $this->tarif($montant);
        $this->benefice();
        $benefices= [];
        $benefices['transfert_agent'] = $this->beneficeTransfert_agent;
        $benefices['retrait_agent'] = $this->beneficeRetrait_agent;
        $benefices['transfert_operateur'] = $this->beneficeTransfert_operateur;
        $benefices['retrait_operateur'] = $this->beneficeRetrait_operateur;
        $benefices['key'] = $this->key;
        
        return $benefices;
    }


    
}