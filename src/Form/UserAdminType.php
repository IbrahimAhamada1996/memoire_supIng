<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserAdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,[
                'required' => true,
            ])
            ->add('prenom',TextType::class,[
                'required' => true,
            ])
            ->add('email',EmailType::class,[
                'required' => true,
            ])
            ->add('roles',ChoiceType::class,[
                'choices'=>[
                    'Employé'=>'ROLE_ADMIN',
                    'ADMIN'=> 'ROLE_SUPER_ADMIN'
                    
                ],
                'expanded' => false,
                'multiple' => true,
                'label' => 'Rôles'
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => ' Les champs du mot de passe doivent correspondre.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
            ])
            ->add('sex',ChoiceType::class,[
                'choices'=>[
                    'Masculin'=>'M',
                    'Feminin'=>'F'
                ]
            ])
            ->add('dateNaiss', DateType::class, [
                // renders it as a single text box
                'widget' => 'single_text',
                'html5' => true,
                ])
            ->add('lieuNaiss')
            ->add('tel',TextType::class,[
                'required' => true,
                ])
                ->add('password', RepeatedType::class, [
                    'type' => PasswordType::class,
                    'invalid_message' => 'The password fields must match.',
                    'options' => ['attr' => ['class' => 'password-field']],
                    'required' => true,
                    'first_options'  => ['label' => 'Password'],
                    'second_options' => ['label' => 'Repeat Password'],
                ])
            ->add('imageFile',FileType::class,[
                'required' => false,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
