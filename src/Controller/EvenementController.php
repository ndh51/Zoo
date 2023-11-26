<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvenementController extends AbstractController
{
    /**
     * @throws Exception
     */
    #[Route('/evenement', name: 'app_evenement')]
    public function index(EvenementRepository $repository, Request $request): Response
    {
        $evenements = $repository->findBy([], ['nomEvent' => 'ASC']);
        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenements,
        ]);
    }

    #[Route('/evenement/{id}', name: 'app_evenement_id', requirements: ['eventId' => '\d+'])]
    public function show(#[MapEntity(expr: 'repository.findWithId(id)')]
        ?Evenement $evenement): Response
    {
        if (is_null($evenement)) {
            return $this->redirectToRoute('app_evenement', status: 303);
        }
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement]);
    }

    #[Route('/evenement/{id}/update', name: 'app_evenement_update', requirements: ['id' => '\d+'])]
    public function update(Evenement $evenement, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EvenementType::class, $evenement);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_evenement_id', ['id' => $evenement->getId()]);
        }

        return $this->render('evenement/update.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView()]);
    }

}

