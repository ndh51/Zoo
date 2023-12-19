<?php

namespace App\Tests\Controller\Animal;

use App\Factory\AnimalFactory;
use App\Factory\CategorieFactory;
use App\Factory\EnclosFactory;
use App\Factory\EvenementFactory;
use App\Factory\FamilleFactory;
use App\Factory\ImageFactory;
use App\Factory\VisiteurFactory;
use App\Tests\Support\ControllerTester;

class UpdateCest
{
    public function formShowsContactDataBeforeUpdating(ControllerTester $I): void
    {
        $img = ImageFactory::createOne(['pathImage' => 'test']);
        $enclos = EnclosFactory::createOne();
        $famille = FamilleFactory::createOne();
        $catg = CategorieFactory::createOne();

        AnimalFactory::createOne(['nomAnimal' => 'Hedwige', 'enclos' => $enclos, 'famille' => $famille, 'categorie' => $catg, 'image' => $img]);

        $post = VisiteurFactory::createOne(['roles' => ['ROLE_ADMIN']]);
        $user = $post->object();
        $I->amLoggedInAs($user);

        $I->amOnPage('/animal/1/update');

        $I->see('Édition de Hedwige', 'h1');
    }

    public function accessIsRestrictedToAuthenticatedUsers(ControllerTester $I): void
    {
        $img = ImageFactory::createOne(['pathImage' => 'test']);
        $enclos = EnclosFactory::createOne();
        $famille = FamilleFactory::createOne();
        $catg = CategorieFactory::createOne();

        AnimalFactory::createOne(['nomAnimal' => 'Hedwige', 'enclos' => $enclos, 'famille' => $famille, 'categorie' => $catg, 'image' => $img]);

        $I->amOnPage('/animal/1/update');
        $I->seeCurrentRouteIs('app_login');
    }

    public function accessIsRestrictedToAdminUsers(ControllerTester $I): void
    {
        $img = ImageFactory::createOne(['pathImage' => 'test']);
        $enclos = EnclosFactory::createOne();
        $famille = FamilleFactory::createOne();
        $catg = CategorieFactory::createOne();

        AnimalFactory::createOne(['nomAnimal' => 'Hedwige', 'enclos' => $enclos, 'famille' => $famille, 'categorie' => $catg, 'image' => $img]);

        $post = VisiteurFactory::createOne(['roles' => ['ROLE_ADMIN']]);
        $user = $post->object();
        $I->amLoggedInAs($user);
        $I->amOnPage('/animal/1/update');
        $I->see('Édition de Hedwige', 'h1');
        $I->seeResponseCodeIs(200);
    }
}
