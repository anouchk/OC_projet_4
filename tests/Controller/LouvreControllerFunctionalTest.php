<?php
namespace App\Tests\Controller;

use App\Controller\LouvreController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class LouvreControllerFunctionalTest extends WebTestCase
{
	public function testHomeStatusCode()
	{
		// on crée un navigateur
		$client = self::createClient();
		$client->request('GET', '/');

		self::assertSame(
			Response::HTTP_OK,
			$client->getResponse()->getStatusCode()
		);
	}

	public function testInfosPratiquesStatusCode()
	{
		// on crée un navigateur
		$client = self::createClient();
		$client->request('GET', '/infospratiques');

		self::assertSame(
			Response::HTTP_OK,
			$client->getResponse()->getStatusCode()
		);
	}
}