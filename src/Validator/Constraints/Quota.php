<?php

namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Quota extends Constraint
{
    public $message = 'Il ne reste plus assez de billets pour ce jour. Nombre de billets restants : **string**';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}