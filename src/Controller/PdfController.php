<?php

namespace App\Controller;

use Knp\Snappy\Pdf;
use App\Entity\Retrait;
use App\Entity\Transfert;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PdfController extends AbstractController
{
     /**
     * @Route("/recue", name="recue")
     */
    public function index(UserInterface $user): Response
      {  
         $data = $this->getDoctrine()->getManager();
        $transfert  = $data->getRepository(Transfert::class)->findBy([
            'user' => $user,],['id' =>'desc',],1,0);
        return $this->render('recu/transfert.html.twig', [
            'transfert' => $transfert,
        ]);
    }

    /**
     * 
     * @Route("/operateur/operation/transfert/reu", name="pdf_recuTransfert")
     */
    public function recuTransfert(Pdf $knpSnappyPdf, UserInterface $user)
    {   
        $data = $this->getDoctrine()->getManager();
        $dataTransfert  = $data->getRepository(Transfert::class)->findBy([
            'user' => $user,],['id' =>'desc',],1,0); 

        $html = $this->renderView('recu/transfert.html.twig', array(
            'transfert' => $dataTransfert,
        ));

        return new PdfResponse(
            $knpSnappyPdf->getOutputFromHtml($html),
            'file.pdf'
        );
    }

     /**
     * 
     * @Route("/operateur/operation/retrait/reu", name="pdf_recuRetrait")
     */
    public function recuRetrait(Pdf $knpSnappyPdf, UserInterface $user)
    {   
        $data = $this->getDoctrine()->getManager();
        $dataRetrait  = $data->getRepository(Retrait::class)->findBy([
            'user' => $user,],['id' =>'desc',],1,0); 
         $this->addFlash('succes',"L'impression s'est déroulée avec succès");
        $html = $this->renderView('recu/retrait.html.twig', array(
            'dataRetrait' => $dataRetrait,
        ));
        
        return new PdfResponse(
            $knpSnappyPdf->getOutputFromHtml($html),
            'file.pdf'
        );
    }
}
