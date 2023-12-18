<?php

namespace App\Controller;

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
}
