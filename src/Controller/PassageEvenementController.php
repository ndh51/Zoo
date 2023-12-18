<?php

namespace App\Controller;

use App\Entity\PassageEvenement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

}
