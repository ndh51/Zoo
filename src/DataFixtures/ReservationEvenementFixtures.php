<?php

namespace App\DataFixtures;

use App\Factory\ReservationEvenementFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ReservationEvenementFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        // $manager->flush();
        ReservationEvenementFactory::createMany(20);
    }

    public function getOrder(): int
    {
        return 12;
    }
}
