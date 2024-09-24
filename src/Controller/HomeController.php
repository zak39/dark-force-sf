<?php

namespace App\Controller;

use App\Service\Api\Repository\PeopleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    public function __construct(private readonly PeopleService $peopleService)
    {
    }

    #[Route('/', name: 'app_home', requirements: ['id' => '\d+'])]
    public function index(Request $request): Response
    {
        $page = $request->query->get('page', 1);

        return $this->render('home/index.html.twig', [
            'personnages' => $this->peopleService->findAll($page)->getResults(),
            'next' => $this->peopleService->findAll($page)->getNext(),
            'previous' => $this->peopleService->findAll($page)->getPrevious()
        ]);
    }

    #[Route('/personnage/{id}', name: 'app_personnage', requirements: ['id' => '\d+'])]
    public function personnage(int $id): Response
    {
        return $this->render('home/personnage.html.twig', [
            'personnage' => $this->peopleService->find($id),
        ]);
    }
}
