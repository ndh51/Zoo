<?php

namespace App\Controller;

use App\Entity\Visiteur;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VisiteurController extends AbstractController
{
    #[Route('/visiteur', name: 'app_visiteur')]
    public function index(): Response
    {
        return $this->render('visiteur/index.html.twig', [
            'controller_name' => 'VisiteurController',
        ]);
    }

    #[Route('/visiteur/{id}', name: 'app_visiteur_id', requirements: ['id' => '\d+'])]
    public function show(#[MapEntity(expr: 'repository.findWithId(id)')] ?Visiteur $visiteur): Response
    {
        if (is_null($visiteur)) {
            return $this->redirectToRoute('app_visiteur', status: 303);
        }

        return $this->render('visiteur/show.html.twig', [
            'visiteur' => $visiteur]);
    }
}
