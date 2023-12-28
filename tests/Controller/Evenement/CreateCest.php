<?php


namespace App\Tests\Controller\Evenement;

use App\Entity\Visiteur;
use App\Factory\VisiteurFactory;
use App\Tests\Support\ControllerTester;

class CreateCest
{
    public function formShowsContactDataBeforeUpdating(ControllerTester $I): void
    {
        $post = VisiteurFactory::createOne(['roles' => ['ROLE_ADMIN']]);
        $user = $post->object();
        $I->amLoggedInAs($user);

        $I->amOnPage('/evenement/create');
        $I->see("Création d'un évènement", 'h1');
    }

    public function accessIsRestrictedToAuthenticatedUsers(ControllerTester $I): void
    {
        VisiteurFactory::createOne([
            'prenomVisiteur' => 'Homer',
            'nomVisiteur' => 'Simpson',
        ]);

        $I->amOnPage('/evenement/create');
        $I->seeCurrentRouteIs('app_login');
    }

}
