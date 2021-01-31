<?php

namespace App\Controller;

use App\Entity\Retrait;
use App\Entity\Transfert;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HistoriqueOperateurController extends AbstractController
{
    /**
     * @Route("/operateur/historique/operateur", name="historique_operateur")
     */
    public function index(): Response
    {
        return $this->render('historique_operateur/index.html.twig', [
            'controller_name' => 'HistoriqueOperateurController',
        ]);
    }

    /**
     * @Route("operateur/historique/transfert", name="historique_operateur_transfert")
     */
    public function transfert(UserInterface $user): Response
    {
        $rep = $this->getDoctrine()->getRepository(Transfert::class);
        $transferts = $rep->findBy([
            'user' => $user,
        ]);
        // dd($transferts);
        return $this->render('operation/transfert_list.html.twig', [
            'transferts'=> $transferts,
        ]);
    }

     /**
     * @Route("operateur/historique/{id}/transfert", name="historique_operateur_show")
     */
    public function show(UserInterface $user,Transfert $transfert): Response
    {
       
        // dd($retraits);
        return $this->render('operation/transfert_show.html.twig', [
            'transfert'=> $transfert,
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
        ]);
        // dd($retraits);
        return $this->render('operation/retrait_list.html.twig', [
            'retraits'=> $retraits,
        ]);
    }

    
}
