<?php

namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class MinimumValidator extends ConstraintValidator
{

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint)
    {
        if (strlen($value) < 5) {
            $this->context->buildViolation($constraint->message)
                          ->setParameter('** value **', $value)
                          ->addViolation();
        }
    }
}