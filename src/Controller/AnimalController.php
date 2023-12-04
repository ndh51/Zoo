<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Form\AnimalType;
use App\Repository\AnimalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/animal/create', name: 'app_animal_create', requirements: ['animalId' => '\d+'])]
    public function create(Request $request, EntityManagerInterface $entityManager)
    {
        $animal = new Animal();
        $form = $this->createForm(AnimalType::class, $animal);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($animal);
            $entityManager->flush();

            return $this->redirectToRoute('app_animal_id', ['id' => $animal->getId()]);
        }

        return $this->render('animal/create.html.twig',
            ['form' => $form->createView()]);

    }

    #[Route('/animal/{id}/update', name: 'app_animal_id_update', requirements: ['animalId' => '\d+'])]
    public function update(Request $request, ?Animal $animal, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(AnimalType::class, $animal);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_animal_id', ['id' => $animal->getId()]);
        }

        return $form = $this->render('animal/update.html.twig', [
            'animal' => $animal,
            'form' => $form,
        ]);
    }

    #[Route('/animal/{id}/delete', name: 'app_animal_id_delete', requirements: ['animalId' => '\d+'])]
    public function delete(Request $request, ?Animal $animal, EntityManagerInterface $entityManager)
    {
    }
}
