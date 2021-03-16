<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Tarif;
use App\Entity\Compte;
use App\Entity\Transfert;
use App\Form\TransfertType;
use App\Services\CodeGenerate;
use App\Services\BeneficeService;
use App\Services\SeuilTransfertService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\String\UnicodeString;

class TransfertController extends AbstractController
{
    /**
     * @Route("/agent/transfert", name="transfert")
     */
    public function index(): Response
    {

        return $this->render('transfert/index.html.twig', [
            'controller_name' => 'TransfertController',
        ]);
    }

    /**
     * @Route("/agent/update/{id}/compte" , name="update_Compte")
     * @Route("/agent/update/{id}/transfert" , name="update_ActionTransfert")
     * @Route("/agent/operation/transfert", name="operation_send")
     */
    public function send(Request $request, Transfert $transfert=NULL, UserInterface $user, CodeGenerate $codeGenerate,BeneficeService $beneficeService,SeuilTransfertService $seuilTransfertService)
    {   
        $cache = true;
        $manager = $this->getDoctrine()->getManager();
        $impression = false;

        if (!$transfert) {
            $transfert = new Transfert();
        }
      
        $transfert = new Transfert();
        $form = $this->createForm(TransfertType::class,$transfert);
        $form->handleRequest($request);
        $compteSuperAdmin = $manager->getRepository(User::class)->findAll();
        // $compteAgent = null;
        foreach ($compteSuperAdmin as $key => $value) {
            
            if ($value->getChoiceroles() === "ROLE_SUPER_ADMIN") {
                
                $compteSuperAdmin = $manager->getRepository(User::class)->findAll()[$key];
            }  
        }
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            if ($user->getCompte()->getSolde() >= $transfert->getMontant()) { 
                // dump($beneficeService->tabBenefice($transfert->getMontant())['key']);
                // dump($beneficeService);
                $k = $manager->getRepository(Tarif::class)->findAll()[$beneficeService->tabBenefice($transfert->getMontant())['key']];
                
                $impression = true;
                $cache = false;
                
              
                $transfert->setSeuilTransfert($seuilTransfertService->seuil());
                $transfert->setDateTransfert(new \DateTime());
                $transfert->setCodeTransfert($codeGenerate->generate());
                $transfert->setUser($user);
                $transfert->setvilleEnvoi($user->getAgence()->getVille()->getLibelle());
                $transfert->setTarif($k);
              
                dd($transfert);
                
                $updateSolde = $user->getCompte()->getSolde() - $transfert->getMontant() + $beneficeService->tabBenefice($transfert->getMontant())['transfert_agent'];
                
                $compte = $manager->getRepository(Compte::class)->find($user->getCompte()->setSolde($updateSolde,1));
            
                $compteSuperAdmin->getCompte()->setSolde($beneficeService->tabBenefice($transfert->getMontant())['transfert_operateur']);
                $manager->persist($compteSuperAdmin);
                $manager->persist($compte);
                $manager->persist($transfert);

                $manager->flush();
               
                $telAgence = str_replace(' ','',$user->getTel()) ;
                $telBeneficiaire = str_replace(' ','',$request->request->get('transfert')['phoneBeneficiaire']);
                $montant = (float)$request->request->get('transfert')['montant'] - $beneficeService->tarif((float)$request->request->get('transfert')['montant']);
                $nomCompleteExp = $request->request->get('transfert')['prenomExpediteur']." ".$request->request->get('transfert')['nomExpediteur'];
               
                // dd($mtcn);
                $message = "S-Money:Vous avez reçu une somme de $montant FCFA de la part de  {$nomCompleteExp}. MTCN: {$transfert->getCodeTransfert()}";
                $message = urlencode($message);
                
               
                $url="http://192.168.1.17:13013/cgi-bin/sendsms?username=admin&password=passer&from=$telAgence&to=$telBeneficiaire&text=$message";
                file($url);
                
                $this->addFlash('succes','Le transfert se dérouler avec succès');
                return $this->redirectToRoute('operation_send');
            }else {

                $this->addFlash( 'danger','Votre solde est insuffisant');
            }

        }elseif ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash( 'danger','Reéssaye encore!!');
        }
        
        $dataTransfert  = $manager->getRepository(Transfert::class)->findBy([
                'user' => $user,],['id' =>'desc',],1,0);
        return $this->render('transfert/send_money.html.twig',[
                'formTransfert'=> $form->createView(),
                'dataTransfert' => $dataTransfert,
                'cache' => $cache,
                'transfert' => $manager->getRepository(Transfert::class)->findBy(['user' => $user]),
                'impression' => $impression,  
        ]);
    }

    /**
     * @Route("/agent/transfert/transfert/show", name="transfert_target_recu")
     */
    public function target_recu()
    {
       return  $this->render("recu/transfert.html.twig",[

        ]);
     }        
              
}

