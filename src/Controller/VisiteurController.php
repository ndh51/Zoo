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
        $tickets = $ticketRepository->findEventsByVisiteur($visiteur->getId());
        if (is_null($visiteur)) {
            return $this->redirectToRoute('app_home', status: 303);
        }

        return $this->render('visiteur/show.html.twig', [
            'visiteur' => $visiteur, 'tickets' => $tickets]);
    }
}
