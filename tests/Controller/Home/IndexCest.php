<?php

namespace App\Tests\Controller\Home;

use App\Factory\AnimalFactory;
use App\Factory\CategorieFactory;
use App\Factory\EnclosFactory;
use App\Factory\EvenementFactory;
use App\Factory\FamilleFactory;
use App\Factory\ImageFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function testOnHomePage(ControllerTester $I): void
    {
        $enclos = EnclosFactory::createOne();
        $famille = FamilleFactory::createOne();
        $catg = CategorieFactory::createOne();
        $img = ImageFactory::createOne(['pathImage' => 'test']);

        EvenementFactory::createMany(5, ['image' => $img]);
        AnimalFactory::createMany(9, ['enclos' => $enclos, 'famille' => $famille, 'categorie' => $catg, 'image' => $img]);
        $I->amOnPage('/');
        $I->seeResponseCodeIs(200);
        $I->seeNumberOfElements('.carousel-item-maison', 5);
        $I->seeNumberOfElements('.animal', 9);
    }

    public function testOnClickOnAEvenement(ControllerTester $I): void
    {
        $enclos = EnclosFactory::createOne();
        $famille = FamilleFactory::createOne();
        $catg = CategorieFactory::createOne();
        $img = ImageFactory::createOne(['pathImage' => 'test']);

        EvenementFactory::createOne(['nbPlaceMaxEvent' => 50000, 'image' => $img]);
        EvenementFactory::createMany(5, ['image' => $img]);
        AnimalFactory::createMany(9, ['enclos' => $enclos, 'famille' => $famille, 'categorie' => $catg, 'image' => $img]);
        $I->amOnPage('/');
        $I->seeResponseCodeIs(200);
        $I->click('.carousel-item-maison > a');
        $I->seeCurrentRouteIs('app_evenement_id', ['id' => 1]);
        $I->seeResponseCodeIs(200);
    }

    public function testOnClickOnAnAnimal(ControllerTester $I): void
    {
        $enclos = EnclosFactory::createOne();
        $famille = FamilleFactory::createOne();
        $catg = CategorieFactory::createOne();
        $img = ImageFactory::createOne(['pathImage' => 'test']);

        EvenementFactory::createMany(5, ['image' => $img]);
        AnimalFactory::createMany(9, ['enclos' => $enclos, 'famille' => $famille, 'categorie' => $catg, 'image' => $img]);
        $I->amOnPage('/');
        $I->seeResponseCodeIs(200);
        $I->click('.animal > a');
        $I->seeResponseCodeIs(200);
    }

    public function testOnSortedEvenement(ControllerTester $I): void
    {
        $enclos = EnclosFactory::createOne();
        $famille = FamilleFactory::createOne();
        $catg = CategorieFactory::createOne();
        $img = ImageFactory::createOne(['pathImage' => 'test']);

        EvenementFactory::createSequence(
            [
                ['nbPlaceMaxEvent' => 100, 'nomEvent' => 'Otarie plonge', 'image' => $img],
                ['nbPlaceMaxEvent' => 1, 'nomEvent' => 'Lion yoga', 'image' => $img],
                ['nbPlaceMaxEvent' => 10, 'nomEvent' => 'Tigre danse', 'image' => $img],

            ]
        );

        AnimalFactory::createMany(9, ['enclos' => $enclos, 'famille' => $famille, 'categorie' => $catg, 'image' => $img]);

        $I->amOnPage('/');
        $I->seeResponseCodeIs(200);
        $I->click('.carousel-item-maison > a');
        $I->seeCurrentRouteIs('app_evenement_id', ['id' => 1]);
        $I->seeResponseCodeIs(200);
    }
}
