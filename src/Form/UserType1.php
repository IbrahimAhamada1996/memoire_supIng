<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

// class UserType extends AbstractType
// {
    // public function buildForm(FormBuilderInterface $builder, array $options)
    // {
    //     $builder
    //         ->add('nom',TextType::class,[
    //             'required' => true,
    //         ])
    //         ->add('prenom',TextType::class,[
    //             'required' => true,
    //         ])
    //         ->add('email',EmailType::class,[
    //             'required' => true,
    //         ])
    //         ->add('roles',ChoiceType::class,[
    //             'choices'=>[
    //                 'ROLE_OPERATEUR'=>'ROLE_OPERATEUR',
    //                 'ROLE_ADMIN'=>'ROLE_ADMIN',
    //                 'ROLE_SUPER_ADMIN'=> 'ROLE_SUPER_ADMIN'
                    
    //             ],
    //             'expanded' => false,
    //             'multiple' => true,
    //             'label' => 'Rôles'
    //         ])
    //         ->add('password',PasswordType::class)
    //         ->add('confirmPassword',PasswordType::class)
    //         ->add('sex',ChoiceType::class,[
    //             'choices'=>[
    //                 'Masculin'=>'Masculin',
    //                 'Feminin'=>'Feminin'
    //             ]
    //         ])
    //         ->add('dateNaiss')
    //         ->add('lieuNaiss')
    //         ->add('tel',TextType::class,[
    //             'required' => true,
    //             ])
    //             ->add('password', RepeatedType::class, [
    //                 'type' => PasswordType::class,
    //                 'invalid_message' => 'The password fields must match.',
    //                 'options' => ['attr' => ['class' => 'password-field']],
    //                 'required' => true,
    //                 'first_options'  => ['label' => 'Password'],
    //                 'second_options' => ['label' => 'Repeat Password'],
    //             ])
    //         ->add('imageFile',FileType::class,[
    //             'required' => false,
    //         ]);
    //     ;
    // }

    // public function configureOptions(OptionsResolver $resolver)
    // {
    //     $resolver->setDefaults([
    //         'data_class' => User::class,
    //     ]);
    // }
// }
