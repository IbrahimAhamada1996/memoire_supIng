<?php

namespace App\Controller;

use App\Entity\Tarif;
use App\Form\TarifType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TarifController extends AbstractController
{
    /**
     * @Route("/admin/tarif", name="tarif")
     */
    public function index(): Response
    {
        return $this->render('tarif/index.html.twig', [
            'controller_name' => 'TarifController',
        ]);
    }

     /**
      * @Route("/admin/update/{id}/tarif" , name="update_ActionTarif")
     * @Route("/admin/tarif/new", name="create_actionTarif")
     */
    public function actiontatif(Request $request, Tarif $tarif=null): Response
    {
        $manager = $this->getDoctrine()->getManager();
        if (!$tarif) {
            $tarif = new Tarif();
        }
        
        $form = $this->createForm(TarifType::class,$tarif);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($tarif);
            $manager->flush();
            $this->addFlash('succes','l\'enregistrement a été bien reçu');

             return $this->redirectToRoute('create_actionTarif');

        }elseif($form->isSubmitted() && !$form->isValid()) {

            $this->addFlash( 'danger','Reéssaye encore!!');
        }

        $rep = $this->getDoctrine()->getRepository(Tarif::class);
        $tarifAll = $rep->findAll();

        return $this->render('tarif/action_form.html.twig', [
            'formTarif' => $form->createView(),
            'editMode'=> $tarif->getId()!==null,
            'tarifs'=>$tarifAll,
            
        ]);
    }

     /**
     *@Route("/admin/tarifs/list", name="tarifs_list")
     */
    public function list(){
        $rep = $this->getDoctrine()->getRepository(Tarif::class);
        $tarifAll = $rep->findAll();
        dump($tarifAll);
        
        return $this->render("tarif/list_admin.html.twig",[
            'tarifs'=>$tarifAll,
        ]);
    }
    
    /**
     *@Route("/admin/tarifs/{id}/show", name="tarif_show")
     */
    public function show(Tarif $tarif){
       

        return $this->render("tarif/show.html.twig",[
            'tarif'=>$tarif
        ]);
    }
    /**
     * @Route("admin/tarif/{id}/delete" ,name="tarif_delete")
     */
    public function delete(Tarif $tarif){
       $manager = $this->getDoctrine()->getManager();
       $manager->remove($tarif);
       $manager->flush();
       return $this->redirectToRoute("tarifs_list");
    }

     /**
     *@Route("/operateur/tarifs/list", name="tarifs_list_operateur")
     */
    public function listOperateur(){
        $rep = $this->getDoctrine()->getRepository(Tarif::class);
        $tarifAll = $rep->findAll();
      
        
        return $this->render("tarif/list_operateur.html.twig",[
            'tarifs'=>$tarifAll,
        ]);
    }
}
