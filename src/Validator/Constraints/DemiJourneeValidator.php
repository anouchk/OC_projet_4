<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use App\Entity\Commande;

class DemiJourneeValidator extends ConstraintValidator
{
    public function validate($commande, Constraint $constraint)
    {
        $now = new \DateTime();
        foreach ($commande->getBillets() as $billet) {
        	if (
        		$commande->getDateVisite()->format('Y-m-d') == $now->format('Y-m-d') &&
        		$now->format('H') > 14
        		$billet->getTypeBillet() == 1
        	) {
        		$this->context->buildViolation($constraint->message)
                          ->addViolation();
        	}
        }    
    }
}