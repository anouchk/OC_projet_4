<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class JoursFeries extends Constraint
{
    public $message = "Vous ne pouvez pas réserver pour le ** value ** car il s'agit d'un jour férié";
}