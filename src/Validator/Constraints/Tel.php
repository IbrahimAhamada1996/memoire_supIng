<?php
namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Tel extends Constraint
{
    public $message = "Le numéro {{ string }} n'a pas valide, Veuillez respecter le format. ";
}