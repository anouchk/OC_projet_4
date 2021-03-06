<?php

namespace App\Service;

use App\Entity\Billet;
use App\Entity\Commande;

class BilletManager 
{
	public function getAge(Billet $billet, Commande $commande)
	{
		return $billet->getDateNaissance()->diff($commande->getDateVisite())->format('%y%');
		// return $commande->getDateVisite()->diff($billet->getDateNaissance())->y;

	}
}