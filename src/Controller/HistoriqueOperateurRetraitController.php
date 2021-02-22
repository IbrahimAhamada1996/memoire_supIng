<?php

namespace App\Controller;


use App\Entity\Retrait;
use App\Entity\Transfert;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HistoriqueOperateurRetraitController extends AbstractController
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

    /**
     * @Route("operateur/historique/retrait", name="historique_operateur_retrait")
     */
    public function retrait(UserInterface $user): Response
    {
        $rep = $this->getDoctrine()->getRepository(Retrait::class);
        $retraits = $rep->findBy([
            'user' => $user,
        ],['id'=>'desc']);
        // dd($retraits);
        return $this->render('operation_retrait/list.html.twig', [
            'retraits'=> $retraits,
        ]);
    }

     /**
     * @Route("operateur/historique/{id}/retrait", name="historique_operateur_retrait_show")
     */
    public function show(Retrait $retrait): Response
    {
       
        // dd($retraits);
        return $this->render('operation_retrait/show.html.twig', [
            'retrait'=> $retrait,
        ]);
    }

}
