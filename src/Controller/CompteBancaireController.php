<?php

namespace App\Controller;

use App\Entity\Compte;
use App\Form\CompteType;
use App\Services\NumeroCompte;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CompteBancaireController extends AbstractController
{
    /**
     * @Route("/admin/compte/bancaire", name="compte_bancaire")
     */
    public function index(): Response
    {
        return $this->render('compte_bancaire/index.html.twig', [
            'controller_name' => 'CompteBancaireController',
        ]);
    }

     /**
      * @Route("/admin/update/{id}/compte" , name="update_ActionCompte")
     * @Route("/admin/compte/new", name="create_actionCompte")
     */
    public function actionCompte(Request $request,Compte $compte=null, $id=0,NumeroCompte $numeroCompte): Response
    {
        $manager = $this->getDoctrine()->getManager();
        
        if (!$compte) {
            $compte = new Compte();
        }
        
        $form = $this->createForm(CompteType::class,$compte);
        $form->handleRequest($request);
        // $solde  = $manager->getRepository(Compte::class)->findBy(['id'=>$id]);
        //  $addSolde = $solde[0]->getSolde() + (float)$request->request->get('compte')['solde'];
        $numeroCompteRep = $manager->getRepository(Compte::class)->find($id);
        // dump($numeroCompteRep->getDate());
        // dd($numeroCompteRep->getNumeroCompte());

        if($form->isSubmitted() && $form->isValid()){
            if (null != $numeroCompteRep) {
                $compte->setDate($numeroCompteRep->getDate());
                $compte->setNumeroCompte($numeroCompteRep->getNumeroCompte());
                $compte->setSolde($compte->getSolde(),1);
                $manager->persist($compte);
                $manager->flush();
                $this->addFlash('succes','la mise à jour du compte se dérouler avec success');
                return $this->redirectToRoute('create_actionCompte');
            }else {
                
                $compte->setDate(new \DateTime());
                $compte->setNumeroCompte($numeroCompte->numero());
                $manager->persist($compte);
                $manager->flush();
                $this->addFlash('succes','l\'enregistrement a été bien reçu');
                return $this->redirectToRoute('create_actionCompte');
            }
        
            // return $this->redirectToRoute('compte_list');

        }elseif($form->isSubmitted() && !$form->isValid()) {

            $this->addFlash( 'danger','Reéssaye encore!!');
        }

        return $this->render('compte_bancaire/action_form.html.twig', [
            'controller_name' => 'CompteController',
            'formCompte' => $form->createView(),
            'editMode'=> $compte->getId()!==null,
        ]);
    }

    /**
     * @Route("/admin/compte/list", name="compte_list")
     */
    public function list(Request $request): Response
    {
        $rep = $this->getDoctrine()->getRepository(Compte::class);
        $compteAll = $rep->findAll();

        return $this->render('compte_bancaire/list.html.twig', [
            'comptes'=> $compteAll,
            
        ]);
    }

     /**
     *@Route("/admin/compte/{id}/show", name="compte_show")
     */
    public function show(Compte $compte){
       

        return $this->render("user/show.html.twig",[
            'compte'=>$compte
        ]);
    }
    /**
     * @Route("admin/compte/{id}/delete" ,name="compte_delete")
     */
    public function delete(Compte $compte){
       $manager = $this->getDoctrine()->getManager();
       $manager->remove($compte);
       $manager->flush();
       return $this->redirectToRoute("ville_list");
    }
}
