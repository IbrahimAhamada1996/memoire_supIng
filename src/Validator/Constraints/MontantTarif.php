<?php
namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MontantTarif extends Constraint
{
    public $message = "ce montant {{ string }} n'a pas encore de tarif. ";
}