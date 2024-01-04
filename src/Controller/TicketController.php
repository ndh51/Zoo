<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Entity\Voir;
use App\Form\TicketType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TicketController extends AbstractController
{
    #[Route('/ticket/create', name: 'app_ticket_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $currentUser = $this->getUser();

        // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
        if (!$currentUser) {
            return $this->redirectToRoute('app_login');
        }

        $date = $request->query->get('date', '');
        if ('' == $date) {
            return $this->redirectToRoute('app_visiteur_id', ['id' => $currentUser->getId()]);
        }

        try {
            $dateTimeTesteur = new \DateTime($date); // On crée une date de test, si la date n'est pas valide, DateTime renvoie une exception

            $ticket = new Ticket();
            $form = $this->createForm(TicketType::class, $ticket, [
                'currentVisiteur' => $currentUser,
                'date' => $date,
            ]);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                // Gestion des animaux et des évènements
                $lstAnimal = $form->get('vues')->getData();

                foreach ($lstAnimal as $animal) {
                    $vue = new Voir();
                    $vue->setAnimal($animal)
                        ->setTicket($ticket);

                    $ticket->addVue($vue);
                    $entityManager->persist($animal);
                    $entityManager->persist($vue);
                }

                $entityManager->persist($ticket);
                $entityManager->flush();

                return $this->redirectToRoute('app_visiteur', ['id' => $currentUser->getId()]);
            }

            return $this->render('ticket/index.html.twig', [
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
