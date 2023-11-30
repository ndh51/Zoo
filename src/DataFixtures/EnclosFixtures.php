<?php

namespace App\DataFixtures;

use App\Factory\EnclosFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EnclosFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        //EnclosFactory::createMany(5);
    }

    public function getOrder()
    {
        return 3;
    }
}
