<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Entity\Visiteur;
use App\Form\TicketType;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TicketController extends AbstractController
{
    #[Route('/ticket/{id}', name: 'app_ticket', requirements: ['id' => '\d+'])]
    public function create(#[MapEntity(expr: 'repository.findWithId(id)')] ?Visiteur $visiteur, Request $request): Response
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
            $date = $request->query->get('date', '');
            if ('' == $date) {
                return $this->redirectToRoute('app_visiteur_id', ['id' => $currentUser->getId()]);
            }

            $ticket = new Ticket();
            $form = $this->createForm(TicketType::class, $ticket, [
                'currentVisiteur' => $visiteur,
                'date' => $date,
            ]);

            return $this->render('ticket/index.html.twig', [
                'visiteur' => $visiteur,
                'ticket' => $ticket,
                'form' => $form->createView(),
            ]);
        }

        return $this->redirectToRoute('app_home', status: 303);
    }
}
