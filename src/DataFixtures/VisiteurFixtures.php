<?php

namespace App\DataFixtures;

use App\Factory\VisiteurFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class VisiteurFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        VisiteurFactory::createOne(['email' => 'root@root.root', 'roles' => ['ROLE_ADMIN']]);
        VisiteurFactory::createMany(20);
    }

    public function getOrder(): int
    {
        return 8;
    }
}
