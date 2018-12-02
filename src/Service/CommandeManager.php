<?php
namespace App\Service;

class CommandeMannager 
{
	/**
	 * @var Commande
	 */
	private $commande;

	public function initialize()
	{
		$this->commande = new Commande();
	}
	
	public function getCommande()
	{
		return $this->commande;
	}
}