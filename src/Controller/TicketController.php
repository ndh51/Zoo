<?php

namespace App\Controller;

use App\Entity\ReservationEvenement;
use App\Entity\Ticket;
use App\Entity\Voir;
use App\Form\TicketType;
use App\Repository\TicketRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TicketController extends AbstractController
{
    #[Route('/ticket/{id}', name: 'app_ticket_id', requirements: ['id' => '\d+'])]
    public function show(#[MapEntity(expr: 'repository.findWithId(id)')]
        ?Ticket $ticket, TicketRepository $ticketRepo): Response
    {
        if (is_null($ticket)) {
            return $this->redirectToRoute('app_visiteur_id', ['id' => $this->getUser()->getId()]);
        }

        if ($ticket->getVisiteur() !== $this->getUser()) {
            return $this->redirectToRoute('app_home');
        }

        return $this->render('ticket/show.html.twig', ['ticket' => $ticket]);
    }

    #[Route('/ticket/create', name: 'app_ticket_create')]
    public function create(Request $request, EntityManagerInterface $entityManager, TicketRepository $ticketRepository): Response
    {
        $currentUser = $this->getUser();
        // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
        if (!$currentUser) {
            return $this->redirectToRoute('app_login');
        }

        $date = $request->query->get('date', '');
        $nbPers = $request->query->get('nbPers', 1);
        $d = new \DateTime($date);
        if ('' == $date || null != $ticketRepository->findOneBy(['dateTicket' => $d])) {
            return $this->redirectToRoute('app_visiteur_id', ['id' => $currentUser->getId()]);
        }

        try {
            $dateTimeTesteur = new \DateTime($date); // On crée une date de test, si la date n'est pas valide, DateTime renvoie une exception

            $ticket = new Ticket();
            $form = $this->createForm(TicketType::class, $ticket, [
                'currentVisiteur' => $currentUser,
                'date' => $date,
                'nbPers' => intval($nbPers),
            ]);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                // Gestion des animaux et des évènements
                $lstAnimal = $form->get('vues')->getData();
                $lstPassageEvent = $form->get('reservationEvenement')->getData();

                foreach ($lstAnimal as $animal) {
                    $vue = new Voir();
                    $vue->setAnimal($animal)
                        ->setTicket($ticket);
                    $ticket->addVue($vue);
                    $entityManager->persist($vue);
                }

                foreach ($lstPassageEvent as $passageEvent) {
                    $passageEvent->substractNbPlacesRestantes($ticket->getNbPers());
                    $reserv = new ReservationEvenement();
                    $reserv->setPassageEvenement($passageEvent)
                           ->setTicket($ticket);
                    $ticket->addReservationEvenement($reserv);
                    $entityManager->persist($reserv);
                }
                $ticket->setPrixTicket((15 * $nbPers) + (2 * $nbPers * count($lstPassageEvent)));
                $entityManager->persist($ticket);
                $entityManager->flush();

                return $this->redirectToRoute('app_visiteur', ['id' => $currentUser->getId()]);
            }

            return $this->render('ticket/create.html.twig', [
                'visiteur' => $currentUser,
                'ticket' => $ticket,
                'form' => $form->createView(),
            ]);
        } catch (\Exception $e) {
            // On tombe ici la date passée en paramètre n'est pas valide
            return $this->redirectToRoute('app_visiteur_id', ['id' => $currentUser->getId()]);
        }
    }
}
