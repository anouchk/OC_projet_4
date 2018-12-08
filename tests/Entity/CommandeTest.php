<?php
namespace App\Tests\Entity;

use App\Entity\Billet;
use App\Entity\Commande;
use App\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CommandeTest extends KernelTestCase
{
	/**
     * @var Commande
     */
    private $commande;

    public function setUp()
    {
        $this->commande = new Commande();
    }

    public function testGetReference()
    {
        $this->commande->setReference('3R4N5h');
        static::assertSame('3R4N5h', $this->commande->getReference());
    }

    public function testGetateVisite()
    {
    	$dateVisite = new \DateTime('2021-10-01');
        $this->commande->setDateVisite($dateVisite);
        static::assertInstanceOf(\DateTime::class, $this->commande->getDateVisite());
    }

    public function testGetPaid()
    {
    	$this->commande->setPaid(true);
    	static::assertSame(true, $this->commande->getPaid());
    }

     public function testGetClient()
     {
     	$this->commande->setClient(New Client('mail@mail.com'));
        static::assertInstanceOf(Client::class, $this->commande->getClient());
     }

    public function testGetPrix()
    {
    	$this->commande->setPrix(48);
        static::assertSame(48, $this->commande->getPrix());
    }

}