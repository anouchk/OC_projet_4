<?php
namespace App\Service;

use App\Entity\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

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

	public function __construct(RequestStack $request_stack)
	{
		$this->request = $request_stack->getCurrentRequest();
	}

	public function create()
	{
		$this->client = new Client($this->request->request->get('stripeEmail'));
	}

	public function getClient()
	{
		return $this->client;
	}
}