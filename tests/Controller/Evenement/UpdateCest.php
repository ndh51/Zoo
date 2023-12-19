<?php

namespace App\Tests\Controller\Evenement;

use App\Factory\EnclosFactory;
use App\Factory\EvenementFactory;
use App\Factory\ImageFactory;
use App\Factory\VisiteurFactory;
use App\Tests\Support\ControllerTester;
use Codeception\Util\HttpCode;

class UpdateCest
{
    public function formShowsContactDataBeforeUpdating(ControllerTester $I): void
    {
        EnclosFactory::createOne();
        $img = ImageFactory::createOne(['pathImage' => 'test']);

        EvenementFactory::createOne(['nomEvent' => 'Édition de Safari Nocturne', 'image' => $img]);

        $post = VisiteurFactory::createOne(['roles' => ['ROLE_ADMIN']]);
        $user = $post->object();
        $I->amLoggedInAs($user);

        $I->amOnPage('/evenement/1/update');

        $I->see('Édition de Safari Nocturne', 'h1');
    }

    public function accessIsRestrictedToAuthenticatedUsers(ControllerTester $I): void
    {
        EnclosFactory::createOne();
        $img = ImageFactory::createOne(['pathImage' => 'test']);

        EvenementFactory::createOne(['nomEvent' => 'Édition de Safari Nocturne', 'image' => $img]);

        $I->amOnPage('/evenement/1/update');
        $I->seeCurrentRouteIs('app_login');
    }

    public function accessIsRestrictedToAdminUsers(ControllerTester $I): void
    {
        EnclosFactory::createOne();
        $img = ImageFactory::createOne(['pathImage' => 'test']);

        EvenementFactory::createOne(['nomEvent' => 'Édition de Safari Nocturne', 'image' => $img]);

        $post = VisiteurFactory::createOne(['roles' => ['ROLE_ADMIN']]);
        $user = $post->object();
        $I->amLoggedInAs($user);
        $I->amOnPage('/evenement/1/update');
        $I->see('Édition de Safari Nocturne', 'h1');
        $I->seeResponseCodeIs(200);
    }
}
