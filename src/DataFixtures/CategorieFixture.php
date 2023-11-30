<?php

namespace App\DataFixtures;

use App\Factory\CategorieFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CategorieFixture extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $tab = json_decode(file_get_contents(__DIR__.'/data/Categorie.json'), true);
        $catg = $tab['categorie'];
        foreach ($catg as $element) {
            CategorieFactory::createOne(['nomCategorie' => $element['nom']]);
        }
    }
    public function getOrder()
    {
        return 1;
    }
}
