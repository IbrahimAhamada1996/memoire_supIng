<?php

namespace App\Form;

use App\Entity\Retrait;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RetraitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('codeRetrait')
            // ->add('nomBeneficiaire')
            // ->add('prenomBeneficiaire')
            // ->add('numeroPieceBeneficiaire')
            // ->add('user')
            // ->add('etatRetrait')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Retrait::class,
        ]);
    }
}
