<?php

namespace App\Controller;

use App\Entity\Visiteur;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TicketController extends AbstractController
{
    #[Route('/ticket/{id}', name: 'app_ticket', requirements: ['id' => '\d+'])]
    public function create(#[MapEntity(expr: 'repository.findWithId(id)')] ?Visiteur $visiteur): Response
    {
        $currentUser = $this->getUser();

        if (is_null($visiteur)) {
            return $this->redirectToRoute('app_home', status: 303);
        }

        // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
        if (!$currentUser) {
            return $this->redirectToRoute('app_login');
        }

        $userIdFromRoute = $visiteur->getId();

        if ($currentUser->getId() == $userIdFromRoute) {
            return $this->render('ticket/index.html.twig', [
                'controller_name' => 'TicketController',
            ]);
        }

        return $this->redirectToRoute('app_home', status: 303);
    }
}
