<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class JoursPasses extends Constraint
{
    public $message = "Vous ne pouvez pas réserver pour le ** value ** car il s'agit d'un jour passé";
}