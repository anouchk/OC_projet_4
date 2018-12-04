<?php

namespace App\Tests\Entity;

use App\Entity\Billet;
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
}