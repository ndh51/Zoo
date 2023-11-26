<?php

namespace App\Controller;

use App\Entity\Famille;
use App\Repository\FamilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FamilleController extends AbstractController
{
    #[Route('/famille', name: 'app_famille')]
    public function index(FamilleRepository $repository): Response
    {
        $familles = $repository->findBy([]);
        return $this->render('famille/index.html.twig', [
            'familles' => $familles,
        ]);
    }

    #[Route('/famille/{id<\d+>}', name: 'famille')]
    public function show(Famille $famille): Response
    {
        return $this->render('famille/show.html.twig', ['famille' => $famille]);
    }

    #[Route('/famille/create', name: 'app_famille_create')]
    public function create(): Response
    {
        return $this->render('famille/create.html.twig');
    }

    #[Route('/famille/{id<\d+>}/update', name: 'app_famille_id_update')]
    public function update(Famille $famille): Response
    {
        return $this->render('famille/update.html.twig', ['famille' => $famille]);
    }

    #[Route('/famille/{id<\d+>}/delete', name: 'app_famille_id_delete')]
    public function delete(Famille $famille): Response
    {
        return $this->render('famille/delete.html.twig', ['famille' => $famille]);
    }
}
