<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DepenseController extends AbstractController
{
    /**
     * @Route("/depense", name="depense")
     */
    public function index(): Response
    {
        return $this->render('depense/index.html.twig', [
            'controller_name' => 'DepenseController',
        ]);
    }

     /**
     * @Route("/operateur/depense", name="depense_home")
     */
    public function home(UserInterface $userInterface): Response
    {
       
        return $this->render('depense/home.html.twig', [
            'user' => $userInterface,
        ]);
    }
}
