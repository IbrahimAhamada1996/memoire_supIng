<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class EmployerController extends AbstractController
{
   
    
    /**
     * @Route("/operateur/update/{id}/employer/compte" , name="update_ActionEmployer")
     * @Route("/operateur/new/employer/compte", name="create_ActionEmployer")
     */
    public function actionEmployer (Request $request, User $user=NULL, UserPasswordEncoderInterface $encoder, UserInterface $userInterface){
        
        $manager = $this->getDoctrine()->getManager();
        if (!$user) { 
            $user= new User();
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request); 
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $user->setRoles(['ROLE_OPERATEUR_EMPLOYE']);
            $passwordHash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($passwordHash);
            $user->setDateCreation(new \DateTime());
           
            
            $manager->persist($user);
            $manager->flush();
            $this->addFlash('succes','l\'enregistrement a été bien reçu');
            return $this->redirectToRoute('create_ActionEmployer');
            
        }elseif($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash( 'danger','Reéssaye encore!!');
        }

        return $this->render("user/action_form.html.twig",[
            'formUser' => $form->createView(),
            'editMode'=> $user->getId()!==null,
            'user'=>$user
        ]);
    }

     /**
     *@Route("/operateur/users/list", name="users_list_employer")
     */
    public function listEmployer(UserInterface $userInterface){
        $employers = $this->getDoctrine()->getRepository(User::class)->findAll();
        // dd($employers);
        return $this->render("user/list_agent.html.twig",[
            'users'=>$employers
        ]);
    }

    /**
     *@Route("/operateur/employer/{id}/show", name="user_show_employer")
     */
    public function showEmployer(User $employer){
       

        return $this->render("user/show_agent.html.twig",[
            'user'=>$employer
        ]);
    }
}
