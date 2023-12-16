<?php

namespace App\DataFixtures;

use App\Factory\PassageEvenementFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PassageEvenementFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        // $manager->flush();
        PassageEvenementFactory::createMany(20);
    }

    public function getOrder(): int
    {
        return 10;
    }
}
