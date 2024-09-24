<?php

namespace App\Controller;

use App\Service\Api\Repository\PlanetService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PlanetController extends AbstractController
{
    public function __construct(private readonly PlanetService $planetService)
    {
    }

    #[Route('/planet', name: 'app_planet_index', requirements: ['id' => '\d+'])]
    public function index(Request $request): Response
    {
        $page = $request->query->get('page', 1);

        return $this->render('planet/index.html.twig', [
            'planets' => $this->planetService->findAll($page)->getResults(),
            'next' => $this->planetService->findAll($page)->getNext(),
            'previous' => $this->planetService->findAll($page)->getPrevious()
        ]);
    }

    #[Route('/planet/{id}', name: 'app_planet_show', requirements: ['id' => '\d+'])]
    public function show(int $id): Response
    {
        return $this->render('planet/show.html.twig', [
            'planet' => $this->planetService->find($id),
        ]);
    }
}
