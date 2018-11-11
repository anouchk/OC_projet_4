<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class JoursFeriesValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if ($value->format('d-m') === '25-12' OR $value->format('d-m') === '01-05' OR $value->format('d-m') === '01-11' ) {
            $this->context->buildViolation($constraint->message)
                          ->setParameter('** value **', $value->format('d-m-Y'))
                          ->addViolation();
        }      
    }
}