<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Billet;

class ReservationsLouvreFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        for($i = 1; $i <=10; $i++) {
        	$billet = new Billet();   
        	$billet->setNom("Duval" . $i);
        	$billet->setPrenom("Jeanne" . $i);
        	$billet->setPays("France" . $i);
        	$billet->setDateNaissance(new \DateTime());
        	$billet->setTarifReduit(true);
        	$billet->setIdCommande(3);
        	$billet->setType($i);

        	$manager->persist($billet);

        }

        $manager->flush();
    }
}
