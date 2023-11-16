<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnimalController extends AbstractController
{
    #[Route('/animal', name: 'app_animal')]
    public function index(AnimalRepository $repository): Response
    {
        $animaux = $repository->findBy([], ['nomAnimal' => 'ASC']);

        return $this->render('animal/index.html.twig', ['animal' => $animaux]);
    }

    #[Route('/animal/{id<\d+>}', name: 'app_animal_show')]
    public function show(Animal $animal): Response
    {
        return $this->render('animal/show.html.twig', ['animal' => $animal]);
    }
}
