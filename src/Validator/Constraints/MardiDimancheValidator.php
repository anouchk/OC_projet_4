<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class MardiDimancheValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if ($value->format('D') == 'Tues' OR 'Sun') {
            $this->context->buildViolation($constraint->message)
                          ->setParameter('** value **', $value->format('d-m-Y'))
                          ->addViolation();
        }      
    }
}