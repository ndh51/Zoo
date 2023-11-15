<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EvenementRepository $eventRepo): Response
    {
        $temp = $eventRepo->findEvenementsMostPlace();
        $events = [];
        for ($i = 0; $i < 3; ++$i) {
            $events[] = $temp[$i];
        }
        return $this->render('home/index.html.twig', ['events' => $events]);
    }
}
