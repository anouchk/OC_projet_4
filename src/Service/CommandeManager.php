<?php
namespace App\Service;

class CommandeMannager 
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
	 * @var CommandeManager constructor
	 *
	 * @param BilletManager $billetManager
	 */
	public function __construct(BilletManager $BilletManager)
	{
		$this->Billetmanager = $billetManager;
	}

	public function initialize()
	{
		$this->commande = new Commande();
	}
	
	public function getCommande()
	{
		return $this->commande;
	}

	public function computePrice(Commande $commande)
	{
		$prixTotal = 0;

        foreach ($commande->getBillets() as $billet) {
        	$age = $this->billetManager->getAge($billet, $commande);
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

	}
}