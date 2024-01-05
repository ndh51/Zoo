<?php

namespace App\DataFixtures;

use App\Factory\AnimalFactory;
use App\Factory\EvenementFactory;
use App\Factory\ParticiperFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ParticiperFixtures extends Fixture implements OrderedFixtureInterface
{
    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager): void
    {
        //        // Nombre total d'animaux et d'événements générés
        //        $totalNbAnimaux = count(json_decode(file_get_contents(__DIR__.'/data/Animaux.json'), true)['animaux']);
        //        $totalNbEvenements = count(json_decode(file_get_contents(__DIR__.'/data/Evenement.json'), true)['evenements']);
        //
        //        // Génération aléatoire des relations entre animaux et événements
        //        $nbGen = 0;
        //        // Initialisation du tableau
        //        $participations = [];
        //        for ($i = 1; $i < $totalNbEvenements + 1; ++$i) {
        //            $participations[$i] = [];
        //        }
        //        while ($nbGen < 50) {
        //            $animal = random_int(1, $totalNbAnimaux);
        //            $evenement = random_int(1, $totalNbEvenements);
        //            if (!in_array($animal, array_values($participations[$evenement]))) {
        //                ++$nbGen;
        //                $participations[$evenement][] = $animal;
        //                $event = EvenementFactory::find(['id' => $evenement]);
        //                $animal = AnimalFactory::find(['id' => $animal]);
        //                ParticiperFactory::createOne(['evenement' => $event,
        //                    'animal' => $animal]);
        //            }
        //        }
        $participations = json_decode(file_get_contents(__DIR__.'/data/Participation.json'), true)['participations'];
        foreach ($participations as $participation) {
            $evenement = EvenementFactory::find(['nomEvent' => $participation['evenement']]);
            foreach ($participation['animaux'] as $animal) {
                ParticiperFactory::createOne(['evenement' => $evenement, 'animal' => AnimalFactory::find(['nomAnimal' => $animal])]);
            }
        }
    }

    public function getOrder(): int
    {
        return 7;
    }
}
