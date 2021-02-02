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
        

        $tab=['rien',"ok"];
        // dump($tab);
        
       $em = $this->container->get('doctrine.orm.entity_manager');
       $item = $em->getRepository(SeuilTransfert::class)->findAll()[0];
        dump($item->getMin()<= $value);
        dump($item->getMax() >= $value);
       if ($item->getMin() > $value || $item->getMax() < $value) {
        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ string }}', $value)
            ->addViolation();
        }



    }
}