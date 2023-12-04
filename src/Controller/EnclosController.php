<?php

namespace App\Controller;

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
}
