<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EvenementRepository $eventRepo, AnimalRepository $animalRepo): Response
    {
        $events = $eventRepo->findBy([], ['nbPlaceMaxEvent' => 'DESC'], 3);
        $animaux = $animalRepo->findWithTheMostEvent();

        return $this->render('home/index.html.twig', ['evenements' => $events, 'animaux' => $animaux]);
    }

    #[Route('/filter', name: 'app_filter')]
    public function search(EvenementRepository $eventRepo, AnimalRepository $animalRepo, Request $request): Response
    {
        $search = $request->query->get('search', '');
        if ('' == $search) {
            return $this->redirectToRoute('app_home');
        }
        $evenements = $eventRepo->search($search);
        $animaux = $animalRepo->search($search);

        return $this->render('home/filter.html.twig', ['evenements' => $evenements,
                                                            'animaux' => $animaux,
                                                            'recherche' => $search]);
    }
}
