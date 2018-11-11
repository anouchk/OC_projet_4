<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MardiDimanche extends Constraint
{
    public $message = "Vous ne pouvez pas réserver pour le ** value ** car il s'agit d'un mardi (le musée est fermé) ou d'un dimanche (les réservations sont impossibles)";
}