<?php

namespace App\Controller\Admin;

use App\Entity\Animal;
use App\Entity\Enclos;
use App\Entity\Famille;
use App\Entity\Visiteur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Zoo');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::linkToCrud('Animal', 'fas fa-list', Animal::class);
        yield MenuItem::linkToCrud('Add Animal', 'fa fa-tags', Animal::class)->setAction('new');

        yield MenuItem::linkToCrud('Enclos', 'fas fa-list', Enclos::class);
        yield MenuItem::linkToCrud('Add Enclos', 'fa fa-tags', Enclos::class)->setAction('new');

        yield MenuItem::linkToCrud('Famille', 'fas fa-list', Famille::class);
        yield MenuItem::linkToCrud('Add Famille', 'fa fa-tags', Famille::class)->setAction('new');

        yield MenuItem::linkToCrud('Visiteur', 'fas fa-list', Visiteur::class);
        yield MenuItem::linkToCrud('Add Visiteur', 'fa fa-tags', Visiteur::class)->setAction('new');

    }
}
