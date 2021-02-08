<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(): Response
    {
        $name = "salut mes amie";
        return $this->render('accueil/home.html.twig', [
            'controller_name' => 'AccueilController',
            'name'=> $name,
            'res'=> "hello world",
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
