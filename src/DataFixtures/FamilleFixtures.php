<?php

namespace App\DataFixtures;

use App\Factory\FamilleFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FamilleFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $tab = json_decode(file_get_contents(__DIR__.'/data/Famille.json'), true);
        $fam = $tab['familles'];
        foreach ($fam as $element) {
            FamilleFactory::createOne([
                'nomFamille' => $element['nom'],
                'descFamille' => $element['description'],
                ]);
        }
    }

    public function getOrder(): int
    {
        return 2;
    }
}
