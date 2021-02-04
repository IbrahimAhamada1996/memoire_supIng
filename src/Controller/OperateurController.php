<?php

namespace App\Controller;



use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class OperateurController extends AbstractController
{
    /**
     * @Route("/operateur", name="operateur_home")
     */
    public function index(): Response
    {
        
        return $this->render('operateur/home.html.twig', [
            'controller_name' => 'OperateurController',
        ]);
    }

}
