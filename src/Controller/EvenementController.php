<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Repository\EvenementRepository;
use Doctrine\DBAL\Exception;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvenementController extends AbstractController
{
    /**
     * @throws Exception
     */
    #[Route('/evenement', name: 'app_evenement')]
    public function index(EvenementRepository $repository, Request $request): Response
    {
        $evenements = $repository->findAll();

        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenements,
        ]);
    }

    #[Route('/evenement/{id}', name: 'app_evenement_id', requirements: ['eventId' => '\d+'])]
    public function show(#[MapEntity(expr: 'repository.findWithId(id)')]
        ?Evenement $evenement): Response
    {
        if (is_null($evenement)) {
            return $this->redirectToRoute('app_evenement', status: 303);
        }
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement]);
    }
}
