<?php

namespace App\Controller;

use App\Entity\Retrait;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HistoriqueAdminRetraitController extends AbstractController
{
    /**
     * @Route("admin/historique/admin", name="historique_admin")
     */
    public function index(): Response
    {
        return $this->render('historique_admin/index.html.twig', [
            'controller_name' => 'HistoriqueAdminController',
        ]);
    }

    

     /**
     * @Route("admin/historique/retrait", name="historique_admin_retrait")
     */
    public function retrait(): Response
    {
        $rep = $this->getDoctrine()->getRepository(Retrait::class);
        $retraits = $rep->findAll();
        // dd($retraits);
        return $this->render('historique_retrait_admin/list.html.twig', [
            'retraits'=> $retraits,
        ]);
    }

     /**
     * @Route("admin/historique/{id}/retrait", name="historique_admin_retrait_show")
     */
    public function show(Retrait $retrait): Response
    {
       
        // dd($retrait);
        return $this->render('historique_retrait_admin/show.html.twig', [
            'retrait'=> $retrait,
        ]);
    }
}
