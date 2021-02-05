<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class InfoOperateurController extends AbstractController
{
    /**
     * @Route("/operateur/depense", name="depense")
     */
    public function index(): Response
    {
        return $this->render('depense/index.html.twig', [
            'controller_name' => 'DepenseController',
        ]);
    }

     /**
     * @Route("/operateur/info/agent", name="info_agent_show")
     */
    public function show(UserInterface $userInterface): Response
    {
       
        return $this->render('info_agent/show.html.twig', [
            'user' => $userInterface,
        ]);
    }
}
