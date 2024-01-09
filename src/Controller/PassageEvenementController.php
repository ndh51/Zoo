<?php

namespace App\Controller;

use App\Entity\PassageEvenement;
use App\Form\PassageEvenementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class PassageEvenementController extends AbstractController
{
    #[Route('/passage/evenement', name: 'app_passage_evenement')]
    public function index(): Response
    {
        return $this->render('passage_evenement/index.html.twig', [
            'controller_name' => 'PassageEvenementController',
        ]);
    }

    #[Route('/passage/evenement/{id<\d+>}', name: 'app_passage_evenement_id')]
    public function show(PassageEvenement $passageEvenement): Response
    {
        return $this->render('passageEvenement/show.html.twig', [
            'passageEvenement' => $passageEvenement,
        ]);
    }

    #[isGranted('ROLE_ADMIN')]
    #[Route('/passage/evenement/create', name: 'app_passage_evenement_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $passageEvenement = new PassageEvenement();
        $form = $this->createForm(PassageEvenementType::class, $passageEvenement);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $passageEvenement->setNbPlacesRestantes($passageEvenement->getEvenement()->getNbPlaceMaxEvent());
            $entityManager->persist($passageEvenement);
            $entityManager->flush();

            return $this->redirectToRoute('app_passage_evenement_id', ['id' => $passageEvenement->getId()]);
        }

        return $this->render('passageEvenement/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[isGranted('ROLE_ADMIN')]
    #[Route('/passage/evenement/{id<\d+>}/update', name: 'app_passage_evenement_update')]
    public function update(PassageEvenement $passageEvenement, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PassageEvenementType::class, $passageEvenement);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_passage_evenement_id', ['id' => $passageEvenement->getId()]);
        }

        return $this->render('passageEvenement/update.html.twig', [
            'passageEvenement' => $passageEvenement,
            'form' => $form,
        ]);
    }

    #[isGranted('ROLE_ADMIN')]
    #[Route('/passage/evenement/{id<\d+>}/delete', name: 'app_passage_evenement_delete')]
    public function delete(PassageEvenement $passageEvenement, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createFormBuilder()
            ->add('delete', SubmitType::class, ['label' => 'delete'])
            ->add('cancel', SubmitType::class, ['label' => 'cancel'])
            ->getForm();

        $form->handleRequest($request);
        if ($request->isMethod('POST') && $form->isSubmitted() && $form->isValid()) {
            $clickedButton = $form->getClickedButton();

            if ($clickedButton && 'delete' === $clickedButton->getName()) {
                $idEvent = $passageEvenement->getEvenement()->getId();
                $entityManager->remove($passageEvenement);
                $entityManager->flush();

                return $this->redirectToRoute('app_evenement_id', ['id' => $idEvent], status: 303);
            } else {
                return $this->redirectToRoute('app_passage_evenement_id', ['id' => $passageEvenement->getId()], status: 303);
            }
        }

        return $this->render('passageEvenement/delete.html.twig', [
            'passageEvenement' => $passageEvenement,
            'form' => $form,
        ]);
    }
}
