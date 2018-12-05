<?php
namespace App\Tests\Entity;

use App\Entity\Billet;
use App\Entity\Commande;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BilletTest extends KernelTestCase
{
    /**
     * @var Billet
     */
    private $billet;

    public function setUp()
    {
        $this->billet = new Billet();
    }

    public function testGetNom()
    {
        $this->billet->setNom('toto');
        static::assertSame('toto', $this->billet->getNom());
    }

    public function testGetPrenom()
    {
        $this->billet->setPrenom('toto');
        static::assertSame('toto', $this->billet->getPrenom());
    }

    public function testGetPays()
    {
        $this->billet->setPays('France');
        static::assertSame('France', $this->billet->getPays());
    }

    public function testGetDateNaissance()
    {
        $dateNaissance = new \DateTime('1984-10-01');
        $this->billet->setDateNaissance($dateNaissance);
        static::assertInstanceOf(\DateTime::class, $this->billet->getDateNaissance());
    }

    public function testGetTarifReduit()
    {
        $this->billet->setTarifReduit(true);
        static::assertSame(true, $this->billet->getTarifReduit());
    }

    public function testGetCommande()
    {
        $this->billet->setCommande(New Commande);
        static::assertInstanceOf(Commande::class, $this->billet->getCommande());
    }

    public function testGetPrix()
    {
        $this->billet->setPrix(12);
        static::assertSame(12, $this->billet->getPrix());
    }
} 