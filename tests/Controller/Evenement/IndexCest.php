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
        $I->seeNumberOfElements('a', 5);
    }
}
