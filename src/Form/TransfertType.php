<?php

namespace App\Form;

use App\Entity\Transfert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TransfertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('villeEnvoi')
            ->add('montant')
            ->add('nomExpediteur')
            ->add('prenomExpediteur')
            ->add('phoneExpediteur')
            ->add('numeroPieceId')
            ->add('nomBeneficiaire')
            ->add('prenomBeneficiaire')
            ->add('phoneBeneficiaire')
            // ->add('codeTransfert')
            // ->add('dateTransfert')
            // ->add('etatTransfert')
            // ->add('user')
            // ->add('seuilTransfert')
            // ->add('tarif')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Transfert::class,
        ]);
    }
}
