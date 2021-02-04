<?php
namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\DependencyInjection\ContainerInterface;

class TelValidator extends ConstraintValidator
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
    	//$now = new \DateTime('NOW', new \DateTimeZone('Africa/Nairobi'));
    	//$now_heure = new \DateTime($now->format('Y-m-d').' '.$value->format('H:i:s'), new \DateTimeZone('Africa/Nairobi'));
        
        // dump(preg_match("#^[0-9]{2}\s[0-9]{3}\s[0-9]{2}\s[0-9]{2}$#",$value));
            if (!preg_match("#^\+221\s[0-9]{2}\s[0-9]{3}\s[0-9]{2}\s[0-9]{2}$#", $value)) {

                $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
            }

        
    }
}

