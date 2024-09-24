<?php

declare(strict_types=1);

namespace App\Service\Api\Repository;

use App\Service\Dto\ApiFinderAllDto;
use App\Service\Api\StarWarsApiService;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class StarshipService
{    
    public function __construct(private HttpClientInterface $httpClient)
    {
    }

    public function findAll(int $page = 1): ApiFinderAllDto {
        $response = $this->httpClient->request('GET', StarWarsApiService::BASE_URL . '/starships?page=' . $page);
        return ApiFinderAllDto::create($response->toArray());
    }

    public function find(int $id): array {
        $response = $this->httpClient->request('GET', StarWarsApiService::BASE_URL . '/starships/' . $id);
        return $response->toArray();
    }
}
