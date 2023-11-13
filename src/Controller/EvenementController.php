<?php

namespace App\Controller;

use App\Entity\Evenement;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvenementController extends AbstractController
{
    #[Route('/evenement/{id}', name: 'app_evenement_id', requirements: ['eventId' => '\d+'])]
    public function show(#[MapEntity(expr: 'repository.findWithCategory(id)')]
        ?Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement]);
    }
}
