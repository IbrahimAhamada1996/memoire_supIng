<?php

namespace App\Validator\Constraints;

use doctrine;
use App\Entity\SeuilTransfert;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\DependencyInjection\ContainerInterface;


class SeuilGeneraleValidator extends ConstraintValidator
{

    /**
     * @var ContainerInterface
     */
    private $container;
    
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    public function validate($value, Constraint $constraint)
    {
  
       $em = $this->container->get('doctrine.orm.entity_manager');
       $item = $em->getRepository(SeuilTransfert::class)->findAll();
       
       foreach ($item as $v) {
           $item = $v;
       }
    // dd($item);
       if ($item->getMin() > $value || $item->getMax() < $value) {
        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ string }}', $value)
            ->addViolation();
        }



    }
}