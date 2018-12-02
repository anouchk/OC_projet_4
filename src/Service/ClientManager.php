<?php
namespace App\Service;

use App\Entity\Client;
use Symfony\Component\HttpFoundation\Request;

class ClientManager 
{
	/**
	 * @var Request
	 */
	private $request;

	/**
	 * @var Client
	 */
	private $client;

	public function __constructor(RequestStack $request_stack)
	{
		$this->request = $request_stack->getCurrentRequest();
	}

	public function create(Request $request)
	{
		$this->client = return new Client($this->request->request->get('stripeEmail'));
	}

	public function getClient()
	{
		return $this->client;
	}
}