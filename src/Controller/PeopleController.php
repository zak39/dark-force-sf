<?php

namespace App\Controller;

use App\Service\Api\Repository\PeopleService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PeopleController extends AbstractController
{
    public function __construct(private readonly PeopleService $peopleService)
    {
    }

    #[Route('/personnage', name: 'app_personnage_index', requirements: ['id' => '\d+'])]
    public function index(Request $request): Response
    {
        $page = $request->query->get('page', 1);

        return $this->render('people/index.html.twig', [
            'personnages' => $this->peopleService->findAll($page)->getResults(),
            'next' => $this->peopleService->findAll($page)->getNext(),
            'previous' => $this->peopleService->findAll($page)->getPrevious()
        ]);
    }

    #[Route('/personnage/{id}', name: 'app_personnage_show', requirements: ['id' => '\d+'])]
    public function personnage(int $id): Response
    {
        return $this->render('people/show.html.twig', [
            'personnage' => $this->peopleService->find($id),
        ]);
    }
}
