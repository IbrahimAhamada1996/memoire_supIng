<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('roles',ChoiceType::class,[
                'choices'=>[
                    'Agent'=>'ROLE_OPERATEUR',
                    'Employé'=>'ROLE_OPERATEUR_EMPLOYE',
                    'Employé'=>'ROLE_ADMIN_EMPLOYE',
                    'SUPER ADMIN'=> 'ROLE_SUPER_ADMIN'
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
                    'Masculin' => 'M',
                    'Feminin' => 'F',
                ],
               
            ])
            ->add('dateNaiss', DateType::class, [
                // renders it as a single text box
                'widget' => 'single_text',
                'html5' => true,
                ])
            ->add('lieuNaiss')
            ->add('tel')
            // ->add('dateCreation')
            ->add('imageFile',FileType::class,[
                'required' => false,
            ])
            ->add('agence')
            // ->add('compte')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
