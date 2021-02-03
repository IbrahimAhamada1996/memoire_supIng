<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Tarif;
use App\Entity\Compte;
use App\Form\CompteType;
use App\Entity\Transfert;
use App\Form\TransfertType;
use App\Entity\SeuilTransfert;
use App\Services\CodeGenerate;
use App\Services\MontantService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TransfertController extends AbstractController
{
    /**
     * @Route("/operateur/transfert", name="transfert")
     */
    public function index(): Response
    {
        return $this->render('transfert/index.html.twig', [
            'controller_name' => 'TransfertController',
        ]);
    }

     /**
     * @Route("/operateur/update/{id}/compte" , name="update_Compte")
     * @Route("/operateur/update/{id}/transfert" , name="update_ActionTransfert")
     * @Route("operateur/operation/transfert", name="operation_send")
     */
    public function send(Request $request, Transfert $transfert=NULL, UserInterface $user, CodeGenerate $codeGenerate,MontantService $montantService)
    {   
        if (!$transfert) {
            $transfert = new Transfert();
        }
        
        $impression = false;
        $m = $montantService->montantRecu(200);
        $cache = true;
        $manager = $this->getDoctrine()->getManager();
        $transfert = new Transfert();
        $form = $this->createForm(TransfertType::class,$transfert);
        $form->handleRequest($request);
        $tarif = new Tarif();
        
        // $t = $tarif->setTarifClient(1);
        $tarif = $montantService->tarif();
        // dd($tarif);
       
      
        if ($form->isSubmitted() && $form->isValid()) {
            if ($user->getCompte()->getSolde() >= $transfert->getMontant()) {
               
                $impression = true;
                $cache = false;
                $tarif = new Tarif();
                // dd($montant);
                $transfert->setDateTransfert(new \DateTime());
                $transfert->setCodeTransfert($codeGenerate->generate());
                $transfert->setUser($user);
                $transfert->setvilleEnvoi($user->getAgence()->getVille()->getLibelle());
                // $transfert->setEtatTransfert(true);
                // $transfert->setMontant($montantService->montantRecu($transfert->getMontant()));
                // $transfert->setTarif($montantService->id());
    
               
               
                $compte = $manager->getRepository(Compte::class)->find($user->getCompte()->setSolde($user->getCompte()->getSolde() - $transfert->getMontant()));
               
                $manager->persist($compte);
                $manager->persist($transfert);
    
                $manager->flush();
                $this->addFlash('succes','Le transfert se dérouler avec succès');
                return $this->redirectToRoute('operation_send');
            }else {

                $this->addFlash( 'danger','Votre solde est insuffisant');
            }
           
       
        }elseif($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash( 'danger','Reéssaye encore!!');
            // $montantServiceReq = $request->query->get('montant');
            // $montantServicePost = $request->get('montant');

        }
        
        $data = $this->getDoctrine()->getManager();
        $dataTransfert  = $data->getRepository(Transfert::class)->findBy([
                'user' => $user,],['id' =>'desc',],1,0);
     
        return $this->render('transfert/send_money.html.twig',[
                'formTransfert'=> $form->createView(),
                'dataTransfert' => $dataTransfert,
                'cache' => $cache,
                'transfert' => $data->getRepository(Transfert::class)->findBy(['user' => $user]),
                'impression' => $impression,
        ]);
    }
}
