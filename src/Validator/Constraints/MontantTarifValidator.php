<?php
namespace App\Validator\Constraints;


use App\Entity\Tarif;
use App\Entity\Compte;
use App\Entity\Transfert;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MontantTarifValidator extends ConstraintValidator
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
        $em = $this->container->get('doctrine.orm.entity_manager');
        $items = $em->getRepository(Tarif::class)->findAll();
        
        foreach ($items as $key => $v) {
               
            if ($items[$key]->getMin() > $value and $items[$key]->getMax() < $value) {
                dump($items[$key]->getMin());
                dump($items[$key]->getMax());
                dump($value);
                $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
                break;
            }
           
        }
        // dd("eee");
        
    }
}

