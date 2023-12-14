<?php

namespace App\DataFixtures;

use App\Entity\Visiteur;
use App\Factory\TicketFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TicketFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        TicketFactory::createMany(50);
    }

    public function getDependencies()
    {
        return [
            Visiteur::class,
        ];
    }

    public function getOrder(): int
    {
        return 9;
    }

}
