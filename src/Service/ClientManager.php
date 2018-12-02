<?php
namespace App\Service;

use App\Entity\Commande;
use App\Repository\CommandeRepository;

class ClientManager 
{
	public function create()
	{
		return new Client();
	}
}