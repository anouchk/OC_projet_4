<?php

namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class LouvreControllerFunctionalTest extends WebTestCase
{
    public function testIndexStatusCode()
    {
        $client = self::createClient();
        $client->request('GET', '/');

        self::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }

    public function testInfosPratiquesStatusCode()
    {
        $client = self::createClient();
        $client->request('GET', '/infospratiques');

        self::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );

    }

    public function testInfosBilletterieStatusCode()
    {
        $client = self::createClient();
        $client->request('GET', '/billetterie');

        self::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );

    }
}