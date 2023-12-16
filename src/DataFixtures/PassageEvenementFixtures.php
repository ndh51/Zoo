<?php

namespace App\DataFixtures;

use App\Factory\PassageEvenementFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use function Zenstruck\Foundry\create_many;

class PassageEvenementFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        // $manager->flush();
        PassageEvenementFactory::createMany(20);
    }


}
