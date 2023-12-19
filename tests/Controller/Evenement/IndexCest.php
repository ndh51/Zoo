<?php

namespace App\Tests\Controller\Evenement;

use App\Factory\EvenementFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{/*
    public function testOnListOfEvenement(ControllerTester $I): void
    {
        EvenementFactory::createMany(5);
        $I->amOnPage('/evenement');
        $I->seeResponseCodeIs(200);
        $I->seeNumberOfElements('#evenements > a', 5);
    }

    public function testOnClickOnAEvenement(ControllerTester $I): void
    {
        EvenementFactory::createOne(['nomEvent' => 'Aaaaaaaaaa', 'descEvent' => 'Un spectacle de mouettes plutôt sympatique', 'nbPlaceMaxEvent' => 47]);
        EvenementFactory::createMany(5);
        $I->amOnPage('/evenement');
        $I->seeResponseCodeIs(200);
        $I->click('#evenements > a');
        $I->seeCurrentRouteIs('app_evenement_id', ['id' => 1]);
    }

    public function testOnSortedEvenement(ControllerTester $I): void
    {
        EvenementFactory::createSequence(
            [
                ['nomEvent' => 'Spectacle des lions'],
                ['nomEvent' => 'Spectacle des tigres'],
                ['nomEvent' => 'Spectacle des otaries'],
                ['nomEvent' => 'Spectacle des autruches']
            ]
        );
        $I->amOnPage('/evenement');
        $I->seeResponseCodeIs(200);
        $lstEvent = $I->grabMultiple('#evenements > a');
        $I->assertEquals(['Spectacle des autruches', 'Spectacle des lions', 'Spectacle des otaries', 'Spectacle des tigres'], $lstEvent);
    }*/
}
