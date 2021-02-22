<?php

namespace App\Controller;

use App\Entity\Ville;
use App\Form\VilleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VilleController extends AbstractController
{
    /**
     * @Route("/admin/ville", name="ville")
     */
    public function index(): Response
    {
        return $this->render('ville/index.html.twig', [
            'controller_name' => 'VilleController',
        ]);
    }

    /**
     * @Route("/admin/update/{id}/ville" , name="update_ActionVille")
     * @Route("/admin/ville/new", name="create_actionVille")
     */
    public function actionVille(Request $request, Ville $ville=null): Response
    {
        $manager = $this->getDoctrine()->getManager();
        if (!$ville) {
            $ville = new Ville();
        }
        
        $form = $this->createForm(VilleType::class,$ville);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($ville);
            $manager->flush();
            $this->addFlash('succes','l\'enregistrement a été bien reçu');

            return $this->redirectToRoute('create_actionVille');

        }elseif($form->isSubmitted() && !$form->isValid()) {

            $this->addFlash( 'danger','Reéssaye encore!!');
        }

        return $this->render('ville/action_form.html.twig', [
            'controller_name' => 'VilleController',
            'formVille' => $form->createView(),
            'editMode'=> $ville->getId()!==null,
            
        ]);
    }

    /**
     * @Route("/admin/ville/list", name="ville_list")
     */
    public function list(Request $request): Response
    {
        $rep = $this->getDoctrine()->getRepository(Ville::class);
        $villeAll = $rep->findAll();

        return $this->render('ville/list.html.twig', [
            'villes' => $villeAll,
            
        ]);
    }

     /**
     *@Route("/admin/ville/{id}/show", name="ville_show")
     */
    public function show(Ville $ville){
       

        return $this->render("user/show.html.twig",[
            'ville'=>$ville
        ]);
    }
    /**
     * @Route("admin/ville/{id}/delete" ,name="ville_delete")
     */
    public function delete(Ville $ville){
       $manager = $this->getDoctrine()->getManager();
       $manager->remove($ville);
       $manager->flush();
       return $this->redirectToRoute("ville_list");
    }
}
