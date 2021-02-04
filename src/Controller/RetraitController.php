<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Compte;
use App\Entity\Retrait;
use App\Entity\Transfert;
use App\Form\RetraitType;
use App\Services\BeneficeService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RetraitController extends AbstractController
{
   

     /**
     * @Route("/operateur/operation/retrait", name="operation_reseive")
     */
    public function retrait(Request $request, UserInterface $user ,BeneficeService $beneficeService)
    {
        $cache = true;
        $impression = false;
        $em = $this->getDoctrine()->getManager();
        // $codeTransfert = $request->get('retrait')['codeTransfert'];
        $codeTransfert = $request->query->get('codeTransfert');
        $transfert = new Transfert();
        $transfert == null;
        if(null !== $codeTransfert){
            // $em = $this->getDoctrine()->getManager();
            $transfert = $em->getRepository(Transfert::class)->findOneBy([
                'codeTransfert' => $codeTransfert,
            ]);

           
        }
    
        $ret = $em->getRepository(Retrait::class)->findOneBy([
            'codeRetrait' => $codeTransfert,
        ]);
      
        if ($ret !== null  && null !== $transfert ) {

            $this->addFlash( 'danger','ATTENTION!! ce code est déja utilisé');
            $cache =true;
            
        } elseif ($ret === null  && null !== $transfert) {
            $cache =false;
        } elseif($ret === null  && null === $transfert){

            $this->addFlash( 'danger',"$codeTransfert : C'est un code erroné");
        }
           

        $retrait = new Retrait();
        $form = $this->createForm(RetraitType::class, $retrait);
        $form->handleRequest($request);
        $manager = $this->getDoctrine()->getManager();

        $compteSuperAdmin = $manager->getRepository(User::class)->findAll();
        foreach ($compteSuperAdmin as $key => $value) {
            if ($value->getChoiceroles() === "ROLE_SUPER_ADMIN") {
                dump("ok");
                $compteSuperAdmin = $manager->getRepository(User::class)->findAll()[$key];
            }
        }
        
        if ($form->isSubmitted() && $form->isValid()) {
            // dd($transfert);
            $ret = $em->getRepository(Retrait::class)->findOneBy([
                'codeRetrait' => $codeTransfert,
            ]);
            
            if (null !== $ret && null !== $transfert ) {
                    
                $this->addFlash( 'danger','ATTENTION!! ce code est déja utilisé');
               
            }elseif (null === $ret && null !== $transfert && null !== $codeTransfert) {
                $retrait->setCodeRetrait($codeTransfert);
                $retrait->setUser($user);
                $retrait->setEtatRetrait(true);
                $retrait->setDateRetrait(new \DateTime());
                $retrait->setMontant($transfert->getMontant());
                $retrait->setNomExpediteur($transfert->getNomExpediteur());
                $retrait->setPrenomExpediteur($transfert->getPrenomExpediteur());
                $retrait->setPhoneExpediteur($transfert->getPhoneExpediteur());
                $retrait->setNomBeneficiaire($transfert->getNomBeneficiaire());
                $retrait->setPrenomBeneficiaire($transfert->getPrenomBeneficiaire());
                $retrait->setPhoneBeneficiaire($transfert->getPhoneBeneficiaire());
                $retrait->setTarif($transfert->getTarif()->getTarifClient());
                $retrait->setNumeroPieceIdExpediteur($transfert->getNumeroPieceId());

                $transfert = $manager->getRepository(Transfert::class)->findBy(['codeTransfert'=>$codeTransfert])[0]->setEtatTransfert(true);
                
                
                $updateSolde = $user->getCompte()->getSolde() - $transfert->getMontant() + $beneficeService->tabBenefice($retrait->getMontant())['retrait_agent'];
                $compte = $manager->getRepository(Compte::class)->find($user->getCompte()->setSolde($updateSolde,1));
                
                $compteSuperAdmin->getCompte()->setSolde($beneficeService->tabBenefice($retrait->getMontant())['retrait_operateur']);
               
                $manager->persist($compteSuperAdmin);
                $manager->persist($compte);
                $manager->persist($transfert);
                $manager->persist($retrait);

                $manager->flush();
                $this->addFlash('succes',"L'operation s'est dérouler avec succès");
                $impression = true;
            }
        
                
            
        }elseif($form->isSubmitted() && !$form->isValid()) {

                $this->addFlash( 'danger','ERREUR de l\'impression');
            
        }
        $data = $this->getDoctrine()->getManager();
        $dataRetrait  = $data->getRepository(Retrait::class)->findBy([
            'user' => $user,],['id' =>'desc',],1,0);
            
        // dd($dataRetrait);
        return $this->render('retrait/reseive_money.html.twig',[
            'retrait' =>$transfert,
            'cache'=>$cache,
            'formRetrait' => $form->createView(),
            'impression'=> $impression,
            

        ]);
    }
}
