<?php

namespace App\DataFixtures;

use App\Factory\EvenementFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EvenementFixtures extends Fixture
{
    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager): void
    {
        $tab = json_decode(file_get_contents(__DIR__.'/data/Evenement.json'), true);
        $evenements = $tab['evenements'];
        foreach ($evenements as $evenement) {
            EvenementFactory::createOne(['nomEvent' => $evenement['nom'],
                'descEvent' => $evenement['description'],
                'nbPlaceMaxEvent' => random_int(15, 100)]);
        }
    }
}
