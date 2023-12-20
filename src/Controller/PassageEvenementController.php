<?php

namespace App\Controller;

use App\Entity\PassageEvenement;
use App\Form\PassageEvenementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PassageEvenementController extends AbstractController
{
    #[Route('/passage/evenement', name: 'app_passage_evenement')]
    public function index(): Response
    {
        return $this->render('passage_evenement/index.html.twig', [
            'controller_name' => 'PassageEvenementController',
        ]);
    }

    #[Route('/passage/evenement/{id<\d+>}', name: 'app_passage_evenement_id')]
    public function show(PassageEvenement $passageEvenement): Response
    {
        return $this->render('passageEvenement/show.html.twig', [
            'passageEvenement' => $passageEvenement,
        ]);
    }

    #[Route('/passage/evenement/create', name: 'app_passage_evenement_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $passageEvent = new PassageEvenement();
        $form = $this->createForm(PassageEvenementType::class, $passageEvent);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($passageEvent);
            $entityManager->flush();

            return $this->redirectToRoute('app_passage_evenement_id', ['id' => $passageEvent->getId()]);
        }

        return $this->render('passageEvenement/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/passage/evenement/{id<\d+>}/update', name: 'app_passage_evenement_update')]
    public function update(PassageEvenement $passageEvenement): Response
    {
        $form = $this->createForm(PassageEvenementType::class, $passageEvenement);

        return $this->render('passageEvenement/update.html.twig', [
            'passageEvenement' => $passageEvenement,
            'form' => $form,
        ]);
    }
}
