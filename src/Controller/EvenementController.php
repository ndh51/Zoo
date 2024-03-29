<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class EvenementController extends AbstractController
{
    #[Route('/evenement', name: 'app_evenement')]
    public function index(EvenementRepository $repository, Request $request): Response
    {
        $evenements = $repository->findBy([], ['nomEvent' => 'ASC']);

        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenements,
        ]);
    }

    #[Route('/evenement/{id}', name: 'app_evenement_show', requirements: ['id' => '\d+'])]
    public function show(#[MapEntity(expr: 'repository.findWithId(id)')]
        ?Evenement $evenement, EvenementRepository $eventRepo): Response
    {
        if (is_null($evenement)) {
            return $this->redirectToRoute('app_evenement', status: 303);
        }

        $animaux = $eventRepo->findAnimals($evenement);
        $passages = $eventRepo->findPassageForThisWeek($evenement);

        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
            'animaux' => $animaux,
            'passageEvenements' => $passages,
            ]);
    }

    #[isGranted('ROLE_ADMIN')]
    #[Route('/evenement/{id}/update', name: 'app_evenement_update', requirements: ['id' => '\d+'])]
    public function update(Evenement $evenement, ImageRepository $imgRepo, Request $request, EntityManagerInterface $entityManager): Response
    {
        $img = $imgRepo->find($evenement->getImage());
        $form = $this->createForm(EvenementType::class, $evenement, ['default_image' => $img]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_evenement_show', ['id' => $evenement->getId()]);
        }

        return $this->render('evenement/update.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView()]);
    }

    #[isGranted('ROLE_ADMIN')]
    #[Route('/evenement/create', name: 'app_evenement_create')]
    public function create(Request $request, ImageRepository $imgRepo, EntityManagerInterface $entityManager): Response
    {
        $img = $imgRepo->find(1);
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement, ['default_image' => $img]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($evenement);
            $entityManager->flush();

            return $this->redirectToRoute('app_evenement_show', ['id' => $evenement->getId()]);
        }

        return $this->render('evenement/create.html.twig',
            ['form' => $form->createView()]);
    }

    #[isGranted('ROLE_ADMIN')]
    #[Route('/evenement/{id}/delete', name: 'app_evenement_delete', requirements: ['id' => '\d+'])]
    public function delete(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createFormBuilder()
            ->add('delete', SubmitType::class, ['label' => 'delete'])
            ->add('cancel', SubmitType::class, ['label' => 'cancel'])
            ->getForm();

        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isSubmitted() && $form->isValid()) {
            $clickedButton = $form->getClickedButton();

            if ($clickedButton && 'delete' === $clickedButton->getName()) {
                $entityManager->remove($evenement);
                $entityManager->flush();

                return $this->redirectToRoute('app_evenement', status: 303);
            } else {
                return $this->redirectToRoute('app_evenement_show', ['id' => $evenement->getId()], status: 303);
            }
        }

        return $this->render('evenement/delete.html.twig', [
            'form' => $form->createView(),
            'evenement' => $evenement,
        ]);
    }
}
