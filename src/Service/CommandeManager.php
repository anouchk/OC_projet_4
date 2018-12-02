<?php
namespace App\Service;

use App\Entity\Commande;
use App\Repository\CommandeRepository;

class CommandeManager 
{
	/**
	 * @var Commande
	 */
	private $commande;

	/**
	 * @var BilletManager
	 */
	private $billetManager;

	/**
	 * @var CommandeRepository
	 */
	private $commandeRepository;

	/**
	 * @var CommandeManager constructor
	 *
	 * @param BilletManager $billetManager
	 */
	public function __construct(BilletManager $billetManager, CommandeRepository $commandeRepository)
	{
		$this->billetManager = $billetManager;
		$this->CommandeRepository = $commandeRepository;
	}

	public function initialize()
	{
		$this->commande = new Commande();
	}
	
	public function getCommande($id = null)
	{
		if (is_null($id)) {
			$this->commande = new Commande ;
		} else {
			$this->commande = $this->CommandeRepository->find($id);
		}
		return $this->commande;
	}

	public function computePrice(Commande $commande)
	{
		$this->commande = $commande;
		$prixTotal = 0;

        foreach ($this->commande->getBillets() as $billet) {
        	$age = $this->billetManager->getAge($billet, $this->commande);
            if ($billet->getTypeBillet() == 2) {
                $billet->setPrix(8);
            } elseif 
                ($billet->getTarifReduit() == 1) {
                $billet->setPrix(10);
            } elseif ($age > 60 ) {
                $billet->setPrix(12);
            } elseif (12 < $age && $age < 60) { 
                $billet->setPrix(16);
            } elseif (4 < $age && $age < 12) {
                $billet->setPrix(8);
            } elseif ($age < 4) {
                $billet->setPrix(0);
            }  
           
            // calcul du prix total de la commande
            $prixTotal = $prixTotal + $billet->getPrix();
        }

        $this->commande->setPrix($prixTotal);

	}

	public function save ()
	{
		$this->CommandeRepository->save($this->commande);
	}
}