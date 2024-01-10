<?php

namespace App\Tests\Controller\Evenement;

use App\Factory\EnclosFactory;
use App\Factory\EvenementFactory;
use App\Factory\ImageFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function testOnListOfEvenement(ControllerTester $I): void
    {
        EnclosFactory::createOne();
        $img = ImageFactory::createOne(['pathImage' => 'test']);

        EvenementFactory::createMany(5, ['image' => $img]);
        $I->amOnPage('/evenement');
        $I->seeResponseCodeIs(200);
        $I->seeNumberOfElements('.list-group-item.list-group-item-action > a', 5);
    }

    public function testOnClickOnAEvenement(ControllerTester $I): void
    {
        EnclosFactory::createOne();
        $img = ImageFactory::createOne(['pathImage' => 'test']);

        EvenementFactory::createOne(['nomEvent' => 'Aaaaaaaaaa', 'descEvent' => 'Un spectacle de mouettes plutôt sympatique', 'nbPlaceMaxEvent' => 47, 'image' => $img]);
        EvenementFactory::createMany(5, ['image' => $img]);

        $I->amOnPage('/evenement');
        $I->seeResponseCodeIs(200);
        $I->click('.list-group-item.list-group-item-action > a');
        $I->seeCurrentRouteIs('app_evenement_show', ['id' => 1]);
    }

    public function testOnSortedEvenement(ControllerTester $I): void
    {
        EnclosFactory::createOne();
        $img = ImageFactory::createOne(['pathImage' => 'test']);

        EvenementFactory::createSequence(
            [
                ['nomEvent' => 'Spectacle des lions', 'image' => $img],
                ['nomEvent' => 'Spectacle des tigres', 'image' => $img],
                ['nomEvent' => 'Spectacle des otaries', 'image' => $img],
                ['nomEvent' => 'Spectacle des autruches', 'image' => $img],
            ]
        );
        $I->amOnPage('/evenement');
        $I->seeResponseCodeIs(200);
        $lstEvent = $I->grabMultiple('.list-group-item.list-group-item-action  > a');
        $I->assertEquals(['Spectacle des autruches', 'Spectacle des lions', 'Spectacle des otaries', 'Spectacle des tigres'], $lstEvent);
    }
}
