<?php

namespace App\Controller;

use App\Service\Api\Repository\StarshipService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StarshipController extends AbstractController
{
    public function __construct(private StarshipService $starshipService)
    {
    }
    
    #[Route('/starships', name: 'app_starship_index', requirements: ['id' => '\d+'])]
    public function index(Request $request): Response
    {
        $page = $request->query->get('page', 1);

        return $this->render('starship/index.html.twig', [
            'starships' => $this->starshipService->findAll($page)->getResults(),
            'next' => $this->starshipService->findAll($page)->getNext(),
            'previous' => $this->starshipService->findAll($page)->getPrevious(),
        ]);
    }

    #[Route('/starships/{id}', name: 'app_starship_show', requirements: ['id' => '\d+'])]
    public function show(int $id): Response {
        return $this->render('starship/show.html.twig', [
            'starship' => $this->starshipService->find($id)
        ]);
    }
}
