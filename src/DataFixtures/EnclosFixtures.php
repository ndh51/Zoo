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
        $tab = json_decode(file_get_contents(__DIR__.'/data/Enclos.json'), true);
        $encl = $tab['enclos'];
        foreach ($encl as $element) {
            EnclosFactory::createOne([
                'nomEnclos' => $element['nom'],
            ]);
        }
    }

    public function getOrder(): int
    {
        return 3;
    }
}
