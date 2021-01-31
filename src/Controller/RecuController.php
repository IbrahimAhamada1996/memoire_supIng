<?php

namespace App\Controller;

use App\Entity\Retrait;
use App\Form\RetraitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecuController extends AbstractController
{
    /**
     * @Route("/operateur/recu", name="recu")
     */
    public function index(): Response
    {
        return $this->render('recu/index.html.twig', [
            'controller_name' => 'RecuController',
        ]);
    }

     /**
     * @Route("operateur/operation/imprimer", name="recu_imprimer")
     */
    public function imprimer(Request $request, UserInterface $user): Response
    {
        $manager = $this->getDoctrine()->getManager();
        $retrait = new Retrait();
        // $form = $this->createForm(RetraitType::class,$retrait);
        // $form->handleRequest($request);

        $form = $this->createFormBuilder($retrait)
            ->setAction($this->generateUrl('recu_imprimer'))
            ->setMethod('POST')
            ->getForm();
        dd($form);
        
     if ($form->isSubmitted() && $form->isValid()) {
         
        $retrait->setCodeRetrait($codeTransfert);
        $retrait->setUser($user);
        $retrait->setEtatRetrait(true);
        $manager->persist($retrait);
        $manager->flush();
        $this->addFlash('succes','l\'impression a été bien fait');
         
     }

        return $this->render('retrait/reseive_money.html.twig',[
                'formRetrait' => $form->createView(),
        ]);
    }


}
