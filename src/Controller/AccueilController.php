<?php

namespace App\Controller;

use App\Entity\Agence;
use App\Entity\User;
use App\Entity\Ville;
use App\Entity\Retrait;
use App\Entity\Transfert;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(): Response
    {
        $transfert = $this->getDoctrine()->getRepository(Transfert::class)->findAll();
        $retrait = $this->getDoctrine()->getRepository(Retrait::class)->findAll();
        $agences = $this->getDoctrine()->getRepository(Agence::class)->findAll();
        $villes = $this->getDoctrine()->getRepository(Ville::class)->findAll();
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        $agents = [];
        foreach ($users as $key => $value) {
            foreach ($value->getRoles() as $k => $v) {
                if ($v == 'ROLE_OPERATEUR') {
                    $agents[] = $value->getRoles()[$k];
                }
                
            }
           
        }
      
            return $this->render('accueil/home.html.twig', [
            'transferts'=> $transfert,
            'retraits' => $retrait,
            'agents'=> $agents,
            'villes'=> $villes,
            'agences'=>$agences,
        ]);
    }

    /**
     * @Route("/help", name="accueil_help")
     */
    public function help(): Response
    {
      
        return $this->render('accueil/help.html.twig', [
            'controller_name' => 'AccueilController',
           
        ]);
    }
     /**
     * @Route("/about", name="accueil_about")
     */
    public function about(): Response
    {
      
        return $this->render('accueil/about.html.twig', [
            'controller_name' => 'AccueilController',
           
        ]);
    }
     /**
     * @Route("/transfert", name="accueil_transfert")
     */
    public function transfert(): Response
    {
      
        return $this->render('accueil/transfert.html.twig', [
            'controller_name' => 'AccueilController',
           
        ]);
    }
      /**
     * @Route("/retrait", name="accueil_retrait")
     */
    public function retrait(): Response
    {
      
        return $this->render('accueil/retrait.html.twig', [
            'controller_name' => 'AccueilController',
           
        ]);
    }
      /**
     * @Route("/tarif", name="accueil_tarif")
     */
    public function tarif(): Response
    {
      
        return $this->render('accueil/tarif.html.twig', [
            'controller_name' => 'AccueilController',
           
        ]);
    }

     /**
     * @Route("/agence", name="accueil_agence")
     */
    public function agence(): Response
    {
      
        return $this->render('accueil/agence.html.twig', [
            'controller_name' => 'AccueilController',
           
        ]);
    }
}
