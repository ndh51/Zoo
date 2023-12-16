<?php

namespace App\DataFixtures;

use App\Factory\ReservationEvenementFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class ReservationEvenementFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        // $manager->flush();
        ReservationEvenementFactory::createMany(20);
    }
}
