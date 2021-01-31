<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class SeuilGenerale extends Constraint
{
    public $message = 'Ce montant: {{ string }} FCFA ne correspond pas au seuil ';
}