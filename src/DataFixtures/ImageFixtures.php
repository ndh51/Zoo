<?php

namespace App\DataFixtures;

use App\Factory\ImageFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ImageFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $animaux = json_decode(file_get_contents(__DIR__.'/data/Animaux.json'), true)['animaux'];
        $evenements = json_decode(file_get_contents(__DIR__.'/data/Evenement.json'), true)['evenements'];

        foreach ($animaux as $animal) {
//            if (file_exists($_SERVER['DOCUMENT_ROOT'].'/img/animaux/'.$animal['nom'].'.jpg')) {
                ImageFactory::createOne(['pathImage' => '/img/animaux/'.$animal['nom'].'.jpg']);
//            }
        }
        foreach ($evenements as $evenement) {
//            if (file_exists('/public/img/evenements/'.$evenement['nom'].'.jpg')) {
                ImageFactory::createOne(['pathImage' => '/img/evenements/'.$evenement['nom'].'.jpg']);
//            }
        }
    }

    public function getOrder()
    {
        return 4;
    }
}
