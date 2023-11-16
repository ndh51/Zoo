<?php

namespace App\DataFixtures;

use App\Factory\AnimalFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AnimalFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $tab = json_decode(file_get_contents(__DIR__.'/data/Animaux.json'), true);
        $animaux = $tab['animaux'];
        foreach ($animaux as $animal) {
            AnimalFactory::createOne(['nomAnimal' => $animal['nom'],
                'descAnimal' => $animal['description']]);
        }
    }
}
