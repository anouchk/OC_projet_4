<?php

namespace App\Tests\Service;

use App\Entity\Client;
use App\Service\ClientManager;
use App\Service\StripeEmailCatcher;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ClientManagerTest extends KernelTestCase
{
    private $stripeEmailCatcher;

    public function setUp()
    {
        $this->stripeEmailCatcher = $this->createMock(StripeEmailCatcher::class);
        $this->stripeEmailCatcher->method('getEmail')->willReturn('iam@testing.com');
    }

    public function testCreate()
    {
        $manager = new ClientManager($this->stripeEmailCatcher);
        $manager->create();

        static::assertInstanceOf(
            Client::class,
            $manager->getClient()
        );
    }
}