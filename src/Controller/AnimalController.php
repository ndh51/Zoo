<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Repository\AnimalRepository;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnimalController extends AbstractController
{
    #[Route('/animal', name: 'app_animal')]
    public function index(AnimalRepository $repository): Response
    {
        $animaux = $repository->findBy([], ['nomAnimal' => 'ASC']);

        return $this->render('animal/index.html.twig', ['animaux' => $animaux]);
    }

    #[Route('/animal/{id}', name: 'app_animal_id', requirements: ['animalId' => '\d+'])]
    public function show(#[MapEntity(expr: 'repository.findWithId(id)')]
        ?Animal $animal): Response
    {
        if (is_null($animal)) {
            return $this->redirectToRoute('app_animal', status: 303);
        }

        return $this->render('animal/show.html.twig', [
            'animal' => $animal]);
    }
}
