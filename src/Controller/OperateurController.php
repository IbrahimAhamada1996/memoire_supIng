<?php

namespace App\Controller;



use App\Entity\User;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class OperateurController extends AbstractController
{
    /**
     * @Route("/operateur", name="operateur_home")
     */
    public function index(): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        foreach ($users as $key => $value) {
           foreach ($value->getRoles() as $k => $v) {
               if ($v == "ROLE_SUPER_ADMIN") {
                   $telAdmin = $value->getTel();
               };
           }
        }
        // dd($telAdmin);
        return $this->render('operateur/home.html.twig', [
            'telAdmin'=>$telAdmin,
        ]);
    }

}
