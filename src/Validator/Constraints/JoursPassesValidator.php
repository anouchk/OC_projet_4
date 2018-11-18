<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class JoursPassesValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $now = new \DateTime();
        if ($value->format('Y-m-d') < $now->format('Y-m-d')) {
            $this->context->buildViolation($constraint->message)
                          ->setParameter('** value **', $value->format('d-m-Y'))
                          ->addViolation();
        }      
    }
}