<?php
namespace App\Tests\Controller;

use App\Controller\LouvreController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase ;

class LouvreControllerFunctionalTest extends WebTestCase
{
	public function testIndexStatusCode()
	{
		// on crée un navigateur
		$client = self::createClient();
		$client->request('GET', '/');

		self::assertSame(
			200,
			$client->getResponse()->getStatusCode()
		);
	}
}