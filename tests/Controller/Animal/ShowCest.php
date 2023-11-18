<?php


namespace App\Tests\Controller\Animal;

use App\Factory\AnimalFactory;
use App\Tests\Support\ControllerTester;

class ShowCest
{
    public function testOnListOfAnimal(ControllerTester $I): void
    {
        AnimalFactory::createMany(5);
        $I->amOnPage('/animal');
        $I->seeResponseCodeIs(200);
        $I->seeNumberOfElements('.list-group > a', 5);
    }
}
