<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Minimum extends Constraint
{
    public $message = 'La valeur ** value ** est trop courte';
}
