<?php
namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Retrait extends Constraint
{
    public $message = "Vous n'avez assez d'argent {{string}}. ";
}