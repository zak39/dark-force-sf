<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(HttpClientInterface $httpClient): Response
    {
        $personnages = $httpClient->request(
            'GET',
            'https://swapi.dev/api/people/'
        );

        return $this->render('home/index.html.twig', [
            'personnages' => $personnages->toArray()['results'],
        ]);
    }
}
