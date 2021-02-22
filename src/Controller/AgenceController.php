<?php

namespace App\Controller;

use App\Entity\Agence;
use App\Form\AgenceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AgenceController extends AbstractController
{
    /**
     * @Route("/admin/agence", name="agence")
     */
    public function index(): Response
    {
        return $this->render('agence/index.html.twig', [
            'controller_name' => 'AgenceController',
        ]);
    }

    /**
     * @Route("/admin/update/{id}/agence" , name="update_ActionAgence")
     * @Route("/admin/agence/new", name="create_actionAgence")
     */
    public function actionAgence(Request $request,Agence $agence=null): Response
    {
        $manager = $this->getDoctrine()->getManager();
        if (!$agence) {
            $agence  = new Agence();
        }

        $form = $this->createForm(AgenceType::class,$agence);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($agence);
            $manager->flush();
            $this->addFlash('succes','l\'enregistrement a été bien reçu');
            return $this->redirectToRoute('create_actionAgence');
            
        }elseif ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash( 'danger','Reéssaye encore!!');
        }
        return $this->render('agence/action_form.html.twig', [
            'controller_name' => 'AgenceController',
            'formAgence' => $form->createView(),
            'editMode'=> $agence->getId()!==null,
        ]);
    }

     /**
     * @Route("/admin/agence/list", name="agence_list")
     */
    public function list(): Response
    {
        $rep = $this->getDoctrine()->getRepository(Agence::class);
        $agenceAll = $rep->findAll();
        return $this->render('agence/list.html.twig', [
            'agences' => $agenceAll,
            
        ]);
    }
     /**
     *@Route("/admin/agence/{id}/show", name="agence_show")
     */
    public function show(Agence $agence){
       

        return $this->render("agence/show.html.twig",[
            'agence'=>$agence
        ]);
    }
    /**
     * @Route("admin/agence/{id}/delete" ,name="agence_delete")
     */
    public function delete(Agence $agence){
       $manager = $this->getDoctrine()->getManager();
       $manager->remove($agence);
       $manager->flush();
       return $this->redirectToRoute("agence_list");
    }
}
