<?php

namespace App\Tests\Controller\Evenement;

use App\Factory\EvenementFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
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
}
