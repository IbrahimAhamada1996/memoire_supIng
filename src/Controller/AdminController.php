<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Agence;
use App\Entity\Retrait;
use App\Entity\Transfert;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_home")
     */
    public function index(): Response
    {
        // dd(new \DateTime());
        $repUser = $this->getDoctrine()->getRepository(User::class);
        $users =  $repUser->findAll();

        $repAgence = $this->getDoctrine()->getRepository(Agence::class);
        $agences = $repAgence->findAll();
       
        $repTransfert = $this->getDoctrine()->getRepository(Transfert::class);
        $transferts = $repTransfert->findBy(['dateTransfert'=>new \Datetime()]);
        // dd($transferts);
        $repRetrait = $this->getDoctrine()->getRepository(Retrait::class);
        $retraits = $repRetrait->findBy(['dateRetrait'=>new \Datetime()]);
    //    dd($retraits);

        return $this->render('admin/home.html.twig', [
            'users' => $users,
            'agences' => $agences,
            'transferts' => $transferts,
            'retraits' => $retraits,
         
           
        ]);
    }
}
