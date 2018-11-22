<?php

namespace App\Validator\Constraints;

use App\Entity\Commande;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use App\Entity\Billet;

class DemiJourneeValidator extends ConstraintValidator
{
    public function validate($commande, Constraint $constraint)
    {
        $now = new \DateTime();
        $limit = new \DateTime('today 13:00:00');

        /** @var Commande $commande */
        foreach ($commande->getBillets() as $billet) {

            if (
                1 == $billet->getTypeBillet() &&
                ($commande->getDateVisite()->format('Y-m-d') == $now->format('Y-m-d')) &&
                ($now > $limit)
            ) {
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
            }
        }
    }
}