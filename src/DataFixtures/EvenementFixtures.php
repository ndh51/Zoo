<?php

namespace App\DataFixtures;

use App\Factory\EnclosFactory;
use App\Factory\EvenementFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EvenementFixtures extends Fixture implements OrderedFixtureInterface
{
    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager): void
    {
        $tabEv = json_decode(file_get_contents(__DIR__.'/data/Evenement.json'), true);
        $evenements = $tabEv['evenements'];
        foreach ($evenements as $evenement) {
            EvenementFactory::createOne(['nomEvent' => $evenement['nom'],
                'descEvent' => $evenement['description'],
                'nbPlaceMaxEvent' => random_int(15, 100),
                'idEnclos' => EnclosFactory::createOne(['nomEnclos' => $evenement['enclos']])]);
        }
    }

    public function getOrder()
    {
        return 5;
    }
}
