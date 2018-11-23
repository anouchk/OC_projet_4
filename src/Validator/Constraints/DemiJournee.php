<?php
namespace App\Validator\Constraints;
use Symfony\Component\Validator\Constraint;
/**
 * @Annotation
 */
class DemiJournee extends Constraint
{
    public $message = "Vous ne pouvez pas réserver un billet à la journée pour aujourd'hui car il est 14h passées : prenez un billet demi-journée";

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
} 