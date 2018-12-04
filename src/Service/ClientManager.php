<?php
namespace App\Service;

use App\Entity\Client;

class ClientManager 
{
	/**
	 * @var Client
	 */
	private $client;

    /**
     * @var StripeEmailCatcher
     */
	private $stripeEmailCatcher;

	public function __construct(StripeEmailCatcher $stripeEmailCatcher)
	{
		$this->stripeEmailCatcher = $stripeEmailCatcher;
	}

	public function create()
	{
		$this->client = new Client($this->stripeEmailCatcher->getEmail());
	}

	public function getClient()
	{
		return $this->client;
	}
}