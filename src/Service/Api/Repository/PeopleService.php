<?php

declare(strict_types=1);

namespace App\Service\Api\Repository;

use App\Service\StarWarsApiService;
use App\Service\Dto\ApiFinderAllDto;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PeopleService
{    
    public function __construct(private HttpClientInterface $httpClient)
    {
    }

    public function findAll(int $page = 1): ApiFinderAllDto {
        $response = $this->httpClient->request('GET', StarWarsApiService::BASE_URL . '/people?page=' . $page);
        return ApiFinderAllDto::create($response->toArray());
    }

    public function find(int $id): array {
        $response = $this->httpClient->request('GET', StarWarsApiService::BASE_URL . '/people/' . $id);
        return $response->toArray();
    }
}
