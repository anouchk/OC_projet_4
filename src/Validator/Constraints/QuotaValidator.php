<?php
namespace App\Validator\Constraints;
use App\Entity\Commande;
use App\Repository\CommandeRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
class QuotaValidator extends ConstraintValidator
{
    /**
     * @var CommandeRepository
     */
    private $commandeRepository;
    /**
     * QuotaValidator constructor.
     *
     * @param CommandeRepository $commandeRepository
     */
    public function __construct(CommandeRepository $commandeRepository)
    {
        $this->commandeRepository = $commandeRepository;
    }
    public function validate($commande, Constraint $quota)
    {
        $nombreDeBilletsVendus = $this->commandeRepository->nombreDeBilletsVendus($commande->getDateVisite());
        if (3 - $nombreDeBilletsVendus < 0) {
            $string = 0;
        } else {
            $string = 3 - $nombreDeBilletsVendus;
        }
        if ($nombreDeBilletsVendus + sizeof($commande->getBillets()) > 3) {
            $this->context->buildViolation($quota->message)
                ->setParameter('**string**', $string)
                ->addViolation();
        }
    }
} 