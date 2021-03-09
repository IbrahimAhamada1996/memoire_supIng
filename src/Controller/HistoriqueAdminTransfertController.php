<?php

namespace App\Controller;

use App\Entity\Retrait;
use App\Entity\Transfert;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HistoriqueAdminTransfertController extends AbstractController
{
    
     /**
     * @Route("admin/historique/transfert", name="historique_admin_transfert")
     */
    public function transfert(): Response
    {
        $rep = $this->getDoctrine()->getRepository(Transfert::class);
        $transferts = $rep->findAll();
          
        // dd($transferts);
        return $this->render('historique_transfert_admin/list.html.twig', [
            'transferts'=> $transferts,
        ]);
    }

     /**
     * @Route("admin/historique/{id}/transfert", name="historique_admin_transfert_show")
     */
    public function show(Transfert $transfert): Response
    {
       
        // dump($transfert);
        return $this->render('historique_transfert_admin/show.html.twig', [
            'transfert'=> $transfert,
        ]);
    }

    
   

}
