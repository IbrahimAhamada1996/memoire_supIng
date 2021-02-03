<?php

namespace App\Controller;

use App\Entity\Compte;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VirmentController extends AbstractController
{
    /**
     * @Route("/admin/virement/list", name="virment_list")
     */
    public function list(): Response
    {
        $rep = $this->getDoctrine()->getRepository(Compte::class);
        $compteAll = $rep->findAll();
     
        // dd($compteAll);
        return $this->render("virment/list.html.twig",[
            'comptes'=>$compteAll
        ]);
    
    }

    /**
     * @Route("/admin/virment/operateur", name="virment")
     */
    public function virement(): Response
    {
        
        return $this->render('virment/index.html.twig', [
            'controller_name' => 'VirmentController',
        ]);
    }
}
