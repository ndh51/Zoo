<?php

namespace App\Controller;

use App\Entity\Visiteur;
use App\Repository\TicketRepository;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VisiteurController extends AbstractController
{
    #[Route('/visiteur/{id}', name: 'app_visiteur_id', requirements: ['id' => '\d+'])]
    public function show(#[MapEntity(expr: 'repository.findWithId(id)')] ?Visiteur $visiteur, TicketRepository $ticketRepository): Response
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

        if (in_array('ROLE_ADMIN', $currentUser->getRoles(), true) || $currentUser->getId() == $userIdFromRoute) {
            $tickets = $ticketRepository->findEventsByVisiteur($visiteur);

            return $this->render('visiteur/show.html.twig', [
                'visiteur' => $visiteur, 'tickets' => $tickets]);
        }

        return $this->redirectToRoute('app_home', status: 303);
    }
}
