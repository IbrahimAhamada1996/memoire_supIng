<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
     
    /**
     * @Route("/admin/update/{id}/user" , name="update_ActionUser")
     * @Route("/admin/new/user", name="create_ActionUser")
     */
    public function actionUser (Request $request, User $user=NULL, UserPasswordEncoderInterface $encoder){
        
        $manager = $this->getDoctrine()->getManager();
        if (!$user) { 
            $user= new User();
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);  
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $passwordHash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($passwordHash);
            $user->setDateCreation(new \DateTime());
           
            
            $manager->persist($user);
            $manager->flush();
            $this->addFlash('succes','l\'enregistrement a été bien reçu');
            return $this->redirectToRoute('users_list');
            
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
     *@Route("/admin/users/list", name="users_list")
     */
    public function list(){
        $rep = $this->getDoctrine()->getRepository(User::class);
        $userAll = $rep->findAll();
     
        
        return $this->render("user/list.html.twig",[
            'users'=>$userAll
        ]);
    }
    
    /**
     *@Route("/admin/users/{id}/show", name="user_show")
     */
    public function show(User $user){
       

        return $this->render("user/show.html.twig",[
            'user'=>$user
        ]);
    }
    /**
     * @Route("admin/user/{id}/delete" ,name="user_delete")
     */
    public function delete(User $user){
       $manager = $this->getDoctrine()->getManager();
       $manager->remove($user);
       $manager->flush();
       return $this->redirectToRoute("users_list");
    }
}
