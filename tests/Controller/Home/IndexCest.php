<?php


namespace App\Tests\Controller\Home;

use App\Entity\Animal;
use App\Factory\AnimalFactory;
use App\Factory\EnclosFactory;
use App\Factory\EvenementFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function testOnHomePage(ControllerTester $I): void
    {
        EvenementFactory::createMany(5);
        AnimalFactory::createMany(9);
        $I->amOnPage('/');
        $I->seeResponseCodeIs(200);
        $I->seeNumberOfElements('#evenements > a', 3);
        $I->seeNumberOfElements('#animals > a', 9);
    }

    public function testOnClickOnAEvenement(ControllerTester $I): void
    {
        EvenementFactory::createOne(['nbPlaceMaxEvent' => 50000]);
        EvenementFactory::createMany(5);
        AnimalFactory::createMany(9);
        $I->amOnPage('/');
        $I->seeResponseCodeIs(200);
        $I->click('#evenements > a');
        $I->seeCurrentRouteIs('app_evenement_id', ['id' => 1]);
        $I->seeResponseCodeIs(200);
    }
}

