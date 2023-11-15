<?php

namespace App\Controller;

use App\Entity\Animaux;
use App\Repository\AnimauxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnimauxController extends AbstractController
{
    #[Route('/animaux', name: 'app_animaux')]
    public function index(AnimauxRepository $repository): Response
    {
        $animaux = $repository->findBy([], ['name' => 'ASC']);
        return $this->render('animaux/index.html.twig', ['animaux' => $animaux]);
    }

    #[Route('/animaux/{id<\d+>}', name: 'app_animaux_show')]
    public function show(Animaux $animal): Response
    {
        return $this->render('animaux/show.html.twig', ['animal' => $animal]);
    }
}
