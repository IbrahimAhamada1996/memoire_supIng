<?php

namespace App\Controller;

use App\Entity\Transfert;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HistoriqueOperateurTransfertController extends AbstractController
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
        ],['id'=>'desc']);
        // dd($transferts);
        return $this->render('operation_transfert/list.html.twig', [
            'transferts'=> $transferts,
        ]);
    }

     /**
     * @Route("operateur/historique/{id}/transfert", name="historique_operateur_transfert_show")
     */
    public function show(Transfert $transfert): Response
    {
       
        // dd($retraits);
        return $this->render('operation_transfert/show.html.twig', [
            'transfert'=> $transfert,
        ]);
    }

    

    
}
