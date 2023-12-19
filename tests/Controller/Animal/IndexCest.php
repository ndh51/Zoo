<?php

namespace App\Tests\Controller\Animal;

use App\Factory\AnimalFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{/*
    public function testOnListOfAnimal(ControllerTester $I): void
    {
        AnimalFactory::createMany(5);
        $I->amOnPage('/animal');
        $I->seeResponseCodeIs(200);
        $I->seeNumberOfElements('.list-group > a', 5);
    }

    public function testOnClickOnAnAnimal(ControllerTester $I): void
    {
        AnimalFactory::createOne(['nomAnimal' => 'Aaaaaaaaaa', 'descAnimal' => 'Un animal rare au nom facilement prononcable']);
        AnimalFactory::createMany(5);
        $I->amOnPage('/animal');
        $I->seeResponseCodeIs(200);
        $I->click('.list-group > a');
        $I->seeCurrentRouteIs('app_animal_id', ['id' => 1]);
    }

    public function testOnSortedAnimal(ControllerTester $I): void
    {
        AnimalFactory::createSequence(
            [
                ['nomAnimal' => 'Lion'],
                ['nomAnimal' => 'Tigre'],
                ['nomAnimal' => 'Otarie'],
                ['nomAnimal' => 'Autruche'],
            ]
        );
        $I->amOnPage('/animal');
        $I->seeResponseCodeIs(200);
        $lstAnimal = $I->grabMultiple('.list-group > a');
        $I->assertEquals(['Autruche', 'Lion', 'Otarie', 'Tigre'], $lstAnimal);
    }*/
}
