<?php

namespace App\Controller;

use App\Entity\Enclos;
use App\Repository\EnclosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
