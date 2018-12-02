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
		$prix = $commande->getPrix();

		Stripe::setApiKey("sk_test_aXFr9emkHBkD35pC6kAvXLi7");

		try {
            Charge::create[(
                "amount" => $prixCommande * 100, // Amount in cents
                "currency" => "eur",
                "source" => $token,
                "description" => "Paiement Stripe - Réservations Louvre"
            ]);
            
            return true; 

        catch(Card $e) {
            
            return false;
            // The card has been declined
	}
}