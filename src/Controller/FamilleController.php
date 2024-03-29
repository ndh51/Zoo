<?php

namespace App\Controller;

use App\Entity\Famille;
use App\Form\FamilleType;
use App\Repository\FamilleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class FamilleController extends AbstractController
{
    #[isGranted('ROLE_ADMIN')]
    #[Route('/famille', name: 'app_famille')]
    public function index(FamilleRepository $repository): Response
    {
        $familles = $repository->findBy([]);

        return $this->render('famille/index.html.twig', [
            'familles' => $familles,
        ]);
    }

    #[Route('/famille/{id}', name: 'app_famille_show', requirements: ['id' => '\d+'])]
    public function show(Famille $famille): Response
    {
        return $this->render('famille/show.html.twig', ['famille' => $famille]);
    }

    #[isGranted('ROLE_ADMIN')]
    #[Route('/famille/create', name: 'app_famille_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $famille = new Famille();
        $form = $this->createForm(FamilleType::class, $famille);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($famille);
            $entityManager->flush();

            return $this->redirectToRoute('app_famille_show', ['id' => $famille->getId()]);
        }

        return $this->render('famille/create.html.twig',
            ['form' => $form->createView()]);
    }

    #[isGranted('ROLE_ADMIN')]
    #[Route('/famille/{id}/update', name: 'app_famille_update', requirements: ['id' => '\d+'])]
    public function update(Famille $famille, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FamilleType::class, $famille);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_famille_show', ['id' => $famille->getId()]);
        }

        return $this->render('famille/update.html.twig', [
            'famille' => $famille,
            'form' => $form->createView(),
            'animaux' => $famille->getAnimals()]);
    }

    #[isGranted('ROLE_ADMIN')]
    #[Route('/famille/{id}/delete', name: 'app_famille_delete', requirements: ['id' => '\d+'])]
    public function delete(Famille $famille, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createFormBuilder()
            ->add('delete', SubmitType::class, ['label' => 'delete'])
            ->add('cancel', SubmitType::class, ['label' => 'cancel'])
            ->getForm();

        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isSubmitted() && $form->isValid()) {
            $clickedButton = $form->getClickedButton();

            if ($clickedButton && 'delete' === $clickedButton->getName()) {
                $entityManager->remove($famille);
                foreach ($famille->getAnimals() as $animal) {
                    $entityManager->remove($animal);
                }
                $entityManager->flush();

                return $this->redirectToRoute('app_famille', status: 303);
            } else {
                return $this->redirectToRoute('app_famille_show', ['id' => $famille->getId()], status: 303);
            }
        }

        return $this->render('famille/delete.html.twig', [
            'form' => $form,
            'famille' => $famille,
            'animaux' => $famille->getAnimals()]);
    }
}
