<?php

namespace App\Controller;

use App\Entity\Enclos;
use App\Form\EnclosType;
use App\Repository\EnclosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EnclosController extends AbstractController
{
    #[Route('/enclos', name: 'app_enclos')]
    public function index(EnclosRepository $repository): Response
    {
        $enclos = $repository->findBy([], ['nomEnclos' => 'ASC']);

        return $this->render('enclos/index.html.twig', ['enclos' => $enclos]);
    }

    #[Route('/enclos/{id}', name: 'app_enclos_id', requirements: ['id' => '\d+'])]
    public function show(#[MapEntity(expr: 'repository.findWithId(id)')] ?Enclos $enclos): Response
    {
        if (is_null($enclos)) {
            return $this->redirectToRoute('app_enclos', status: 303);
        }

        return $this->render('enclos/show.html.twig', [
            'enclos' => $enclos]);
    }

    #[Route('/enclos/{id}/update', name: 'app_enclos_update', requirements: ['id' => '\d+'])]
    public function update(Enclos $enclos, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EnclosType::class, $enclos);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_enclos_id', ['id' => $enclos->getId()]);
        }

        return $this->render('enclos/update.html.twig', [
            'enclos' => $enclos,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/enclos/create', name: 'app_enclos_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $enclos = new Enclos();
        $form = $this->createForm(EnclosType::class, $enclos);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($enclos);
            $entityManager->flush();

            return $this->redirectToRoute('app_enclos_id', ['id' => $enclos->getId()]);
        }

        return $this->render('enclos/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/enclos/{id}/delete', name: 'app_enclos_delete', requirements: ['id' => '\d+'])]
    public function delete(Enclos $enclos, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createFormBuilder()
            ->add('delete', SubmitType::class, ['label' => 'delete'])
            ->add('cancel', SubmitType::class, ['label' => 'cancel'])
            ->getForm();

        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isSubmitted() && $form->isValid()) {
            $clickedButton = $form->getClickedButton();

            if ($clickedButton && 'delete' === $clickedButton->getName()) {
                foreach ($enclos->getAnimals() as $animal) {
                    foreach ($animal->getParticipations() as $participation) {
                        $entityManager->remove($participation);
                    }
                    $entityManager->remove($animal);
                }
                foreach ($enclos->getEvenements() as $evenement) {
                    foreach ($evenement->getParticipations() as $participation) {
                        $entityManager->remove($participation);
                    }
                    $entityManager->remove($evenement);
                }
                $entityManager->remove($enclos);
                $entityManager->flush();

                return $this->redirectToRoute('app_enclos', status: 303);
            } else {
                return $this->redirectToRoute('app_enclos_id', ['id' => $enclos->getId()], status: 303);
            }
        }

        return $this->render('enclos/delete.html.twig', [
            'enclos' => $enclos,
            'form' => $form,
        ]);
    }
}
