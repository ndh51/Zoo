<?php

namespace App\Tests\Controller\Animal;

use App\Factory\AnimalFactory;
use App\Factory\CategorieFactory;
use App\Factory\EnclosFactory;
use App\Factory\FamilleFactory;
use App\Factory\ImageFactory;
use App\Factory\VisiteurFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function testOnListOfAnimal(ControllerTester $I): void
    {
        $post = VisiteurFactory::createOne(['roles' => ['IS_AUTHENTICATED_FULLY']]);
        $user = $post->object();
        $I->amLoggedInAs($user);

        $enclos = EnclosFactory::createOne();
        $famille = FamilleFactory::createOne();
        $catg = CategorieFactory::createOne();
        $img = ImageFactory::createOne(['pathImage' => 'test']);

        AnimalFactory::createMany(9, ['enclos' => $enclos, 'famille' => $famille, 'categorie' => $catg, 'image' => $img]);
        $I->amOnPage('/animal');
        $I->seeResponseCodeIs(200);

        $I->seeNumberOfElements('.animaux > .animal > a', 9);
    }

    public function testOnClickOnAnAnimal(ControllerTester $I): void
    {
        $post = VisiteurFactory::createOne(['roles' => ['IS_AUTHENTICATED_FULLY']]);
        $user = $post->object();
        $I->amLoggedInAs($user);

        $enclos = EnclosFactory::createOne();
        $famille = FamilleFactory::createOne();
        $catg = CategorieFactory::createOne();
        $img = ImageFactory::createOne(['pathImage' => 'test']);

        AnimalFactory::createOne(['nomAnimal' => 'Aaaaaaaaaa', 'enclos' => $enclos, 'famille' => $famille, 'categorie' => $catg, 'image' => $img]);
        AnimalFactory::createMany(9, ['enclos' => $enclos, 'famille' => $famille, 'categorie' => $catg, 'image' => $img]);

        $I->amOnPage('/animal');
        $I->seeResponseCodeIs(200);

        $I->click('.animaux > .animal > a');
        $I->seeCurrentRouteIs('app_animal_show', ['id' => 1]);
    }

    public function testOnSortedAnimal(ControllerTester $I): void
    {
        $post = VisiteurFactory::createOne(['roles' => ['IS_AUTHENTICATED_FULLY']]);
        $user = $post->object();
        $I->amLoggedInAs($user);

        $enclos = EnclosFactory::createOne();
        $famille = FamilleFactory::createOne();
        $catg = CategorieFactory::createOne();
        $img = ImageFactory::createOne(['pathImage' => 'test']);

        AnimalFactory::createSequence(
            [
                ['nomAnimal' => 'Lion', 'enclos' => $enclos, 'famille' => $famille, 'categorie' => $catg, 'image' => $img],
                ['nomAnimal' => 'Tigre', 'enclos' => $enclos, 'famille' => $famille, 'categorie' => $catg, 'image' => $img],
                ['nomAnimal' => 'Otarie', 'enclos' => $enclos, 'famille' => $famille, 'categorie' => $catg, 'image' => $img],
                ['nomAnimal' => 'Autruche', 'enclos' => $enclos, 'famille' => $famille, 'categorie' => $catg, 'image' => $img],
            ]
        );

        $I->amOnPage('/animal');
        $I->seeResponseCodeIs(200);
        $lstAnimal = $I->grabMultiple('.animaux > .animal > a > p');
        $I->assertEquals(['Lion', 'Tigre', 'Otarie', 'Autruche'], $lstAnimal);
    }
}
