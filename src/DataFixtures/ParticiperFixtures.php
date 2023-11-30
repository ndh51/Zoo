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
    public function load(ObjectManager $manager)
    {
//        // Nombre total d'animaux et d'événements générés
//        $totalNbAnimaux = count(json_decode(file_get_contents(__DIR__.'/data/Animaux.json'), true));
//        $totalNbEvenements = count(json_decode(file_get_contents(__DIR__.'/data/Evenement.json'), true));
//
//
//        // Génération aléatoire des relations entre animaux et événements
//        $nbGen = 0;
//        // Initialisation du tableau
//        $participations = [];
//        for ($i = 1; $i < $totalNbEvenements + 1; ++$i) {
//            $participations[$i] = [];
//        }
//        while ($nbGen < 50) {
//            $idAnimal = random_int(1, $totalNbAnimaux);
//            $idEvent = random_int(1, $totalNbEvenements);
//            if (!in_array($idAnimal, array_values($participations[$idEvent]))) {
//                ++$nbGen;
//                $participations[$idEvent][] = $idAnimal;
//                $participation = ParticiperFactory::createOne(['idEvent' => EvenementFactory::find(['id' => $idEvent]),
//                                                                'idAnimal' => AnimalFactory::find(['id' => $idAnimal])]);
//                $manager->persist($participation);
//            }
//        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 6;
    }
}
