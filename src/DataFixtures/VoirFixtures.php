<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use function Zenstruck\Foundry\create_many;

;

class VoirFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        VoirFactory::create_many(50);
    }

    public function getOrder(): int
    {
        return 11;
    }
}
