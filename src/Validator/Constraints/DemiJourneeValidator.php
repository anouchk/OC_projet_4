<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use App\Entity\Billet;

class DemiJourneeValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $now = new \DateTime();
        if ($billet->getCommande()->getDateVisite()->format('Y-m-d') == $now->format('Y-m-d') && $now->format('H') < 14 && $value == 1) {
            $this->context->buildViolation($constraint->message)
                          ->setParameter('** value **', $value->format('d-m-Y'))
                          ->addViolation();
        }      
    }
}