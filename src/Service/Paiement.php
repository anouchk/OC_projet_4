<?php

namespace App\Service;

use App\Entity\Commande;
use Symfony\Component\HttpFoundation\Request;

class Paiement
{
	/**
	 * @var $Request
	 */
	private $request;

	public function __constructor(RequestStack $request_stack)
	{
		$this->request = $request_stack->getCurrentRequest();
	}

	public function paiement (Commande $commande, Request $request)
	{
		$token = $this->request->request->get('stripeToken');
	}
}