<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Form\AnimalType;
use App\Repository\AnimalRepository;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AnimalController extends AbstractController
{
    #[isGranted('ROLE_ADMIN')]
    #[Route('/animal', name: 'app_animal')]
    public function index(AnimalRepository $repository): Response
    {
        $animaux = $repository->findBy([], ['nomAnimal' => 'ASC']);

        return $this->render('animal/index.html.twig', ['animaux' => $animaux]);
    }

    #[Route('/animal/{id}', name: 'app_animal_show', requirements: ['id' => '\d+'])]
    public function show(#[MapEntity(expr: 'repository.findWithId(id)')]
        ?Animal $animal, AnimalRepository $animalRepo): Response
    {
        if (is_null($animal)) {
            return $this->redirectToRoute('app_home', status: 303);
        }
        $sameFamily = $animalRepo->findWithTheSameFamily($animal);
        $events = $animalRepo->findEvents($animal);

        return $this->render('animal/show.html.twig', [
            'animal' => $animal, 'sameFamille' => $sameFamily, 'events' => $events]);
    }

    #[isGranted('ROLE_ADMIN')]
    #[Route('/animal/create', name: 'app_animal_create')]
    public function create(Request $request, ImageRepository $imgRepo, EntityManagerInterface $entityManager): Response
    {
        $img = $imgRepo->find(1);
        $animal = new Animal();
        $form = $this->createForm(AnimalType::class, $animal, ['default_image' => $img]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($animal);
            $entityManager->flush();

            return $this->redirectToRoute('app_animal_show', ['id' => $animal->getId()]);
        }

        return $this->render('animal/create.html.twig',
            ['form' => $form->createView()]);
    }

    #[isGranted('ROLE_ADMIN')]
    #[Route('/animal/{id}/update', name: 'app_animal_update', requirements: ['id' => '\d+'])]
    public function update(Request $request, ?Animal $animal, ImageRepository $imgRepo, EntityManagerInterface $entityManager): Response
    {
        $img = $imgRepo->find($animal->getImage());
        $form = $this->createForm(AnimalType::class, $animal, ['default_image' => $img]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_animal_show', ['id' => $animal->getId()]);
        }

        return $this->render('animal/update.html.twig', [
            'animal' => $animal,
            'form' => $form->createView(),
        ]);
    }

    #[isGranted('ROLE_ADMIN')]
    #[Route('/animal/{id}/delete', name: 'app_animal_delete', requirements: ['id' => '\d+'])]
    public function delete(Request $request, ?Animal $animal, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createFormBuilder()
            ->add('delete', SubmitType::class, ['label' => 'delete'])
            ->add('cancel', SubmitType::class, ['label' => 'cancel'])
            ->getForm();

        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isSubmitted() && $form->isValid()) {
            $clickedButton = $form->getClickedButton();

            if ($clickedButton && 'delete' === $clickedButton->getName()) {
                $entityManager->remove($animal);

                $entityManager->flush();

                return $this->redirectToRoute('app_animal', status: 303);
            } else {
                return $this->redirectToRoute('app_animal_show', ['id' => $animal->getId()], status: 303);
            }
        }

        return $this->render('animal/delete.html.twig', [
            'animal' => $animal,
            'form' => $form->createView()]);
    }
}
