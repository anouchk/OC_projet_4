<?php

namespace App\Service;

use App\Entity\Commande;
use Stripe\Charge;
use Stripe\Error\Card;
use Stripe\Stripe;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class Paiement
{
	/**
	 * @var $Request
	 */
	private $request;

	public function __construct (RequestStack $request_stack)
	{
		$this->request = $request_stack->getCurrentRequest();
	}

	public function paiement (Commande $commande)
	{
		$token = $this->request->request->get('stripeToken');
		$prix = $commande->getPrix();

		Stripe::setApiKey("sk_test_aXFr9emkHBkD35pC6kAvXLi7");

		try {
            Charge::create([
                "amount" => $prixCommande * 100, // Amount in cents
                "currency" => "eur",
                "source" => $token,
                "description" => "Paiement Stripe - Réservations Louvre"
            ]);
            
            return true; 

        } catch(Card $exception) {
            
            return false;
            // The card has been declined
        };
	}
}