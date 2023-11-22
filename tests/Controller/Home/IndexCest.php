<?php


namespace App\Tests\Controller\Home;

use App\Entity\Animal;
use App\Factory\AnimalFactory;
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
}

