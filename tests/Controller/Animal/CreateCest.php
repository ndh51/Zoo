<?php


namespace App\Tests\Controller\Animal;

use App\Factory\VisiteurFactory;
use App\Tests\Support\ControllerTester;

class CreateCest
{
    public function formShowsContactDataBeforeUpdating(ControllerTester $I): void
    {
        $post = VisiteurFactory::createOne(['roles' => ['ROLE_ADMIN']]);
        $user = $post->object();
        $I->amLoggedInAs($user);

        $I->amOnPage('/animal/create');
        $I->see("Création d'un animal", 'h1');
    }

    public function accessIsRestrictedToAuthenticatedUsers(ControllerTester $I): void
    {
        VisiteurFactory::createOne([
            'prenomVisiteur' => 'Homer',
            'nomVisiteur' => 'Simpson',
        ]);

        $I->amOnPage('/animal/create');
        $I->seeCurrentRouteIs('app_login');
    }
}
