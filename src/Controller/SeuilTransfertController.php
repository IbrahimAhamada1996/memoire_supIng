<?php

namespace App\Controller;

use App\Entity\SeuilTransfert;
use App\Form\SeuilTransfertType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SeuilTransfertController extends AbstractController
{
    /**
     * @Route("/admin/seuil/transfert", name="seuil_transfert")
     */
    public function index(): Response
    {
        return $this->render('seuil_transfert/index.html.twig', [
            'controller_name' => 'SeuilTransfertController',
        ]);
    }

    /**
     * @Route("/admin/update/{id}/seuil" , name="update_ActionSeuilTransfert")
     * @Route("/admin/seuil/transfert/new", name="create_actionSeuilTransfert")
     */
    public function actionCompte(Request $request,SeuilTransfert $seuilTransfert=null): Response
    {
        $caheForm = true;
        $manager = $this->getDoctrine()->getManager();
        if (!$seuilTransfert) {
            $seuilTransfert = new SeuilTransfert();
            $caheForm = false;
        }
       
        $form = $this->createForm(SeuilTransfertType::class,$seuilTransfert);
        $form->handleRequest($request); 
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($seuilTransfert);
            $manager->flush();

            
            $this->addFlash('succes','l\'enregistrement a été bien reçu');

            return $this->redirectToRoute('create_actionSeuilTransfert');

        }elseif($form->isSubmitted() && !$form->isValid()) {

            $this->addFlash( 'danger','Reéssaye encore!!');
        }
        $rep = $this->getDoctrine()->getRepository(SeuilTransfert::class);
        $seuilTransfertAll = $rep->findAll();
       
        return $this->render('seuil_transfert/action_form.html.twig', [
            'formSeuilTransfert' => $form->createView(),
            'editMode'=> $seuilTransfert->getId()!== null,
            'seuilTransferts'=> $seuilTransfertAll,
            'cacheForm' => $caheForm,
        ]);
    }

    /**
     * @Route("admin/seuil transfert/{id}/delete" ,name="seuilTransfert_delete")
     */
    public function delete(SeuilTransfert $seuil){
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($seuil);
        $manager->flush();
        return $this->redirectToRoute("create_actionSeuilTransfert");
     }
}
