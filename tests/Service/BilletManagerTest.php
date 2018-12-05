<?php
namespace App\Tests\Service;
use App\Entity\Billet;
use App\Entity\Commande;
use App\Service\BilletManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BilletManagerTest extends KernelTestCase
{
    /**
     * @var Billet
     */
    private $billet;

    /**
     * @var Commande
     */
    private $commande;

    public function setUp()
    {
        $this->billet = $this->createMock(Billet::class);
        $this->billet->method('getDateNaissance')->willReturn(new \DateTime('1984-10-01'));
        $this->commande = $this->createMock(Commande::class);
        $this->commande->method('getDateVisite')->willReturn(new \DateTime('2019-12-01'));
    }
    
    public function testGetAge()
    {
        $billetManager = new BilletManager();
        static::assertSame('35', $billetManager->getAge($this->billet, $this->commande));
    }
} 