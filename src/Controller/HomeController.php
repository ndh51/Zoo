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
        $temp = $eventRepo->findBy([], ['nbPlaceMaxEvent' => 'DESC']);
        $events = [];
        for ($i = 0; $i < 3; ++$i) {
            $events[] = $temp[$i];
        }
        $animaux = $animalRepo->findAll();
        return $this->render('home/index.html.twig', ['evenements' => $events, 'animaux' => $animaux]);
    }

    #[Route('/filter', name: 'app_filter')]
    public function search(EvenementRepository $eventRepo, AnimalRepository $animalRepo, Request $request)
    {
        $search = $request->query->get('search', '');
        $evenements = $eventRepo->search($search);
        $animaux = $animalRepo->search($search);
        return $this->render('home/filter.html.twig', ['evenements' => $evenements,
                                                            'animaux' => $animaux,
                                                            'recherche' => $search]);
    }
}