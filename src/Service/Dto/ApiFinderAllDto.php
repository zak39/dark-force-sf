<?php

namespace App\Service\Dto;

readonly class ApiFinderAllDto
{
    private function __construct(
        private int $count,
        private ?int $next,
        private ?int $previous,
        private array $results,
    )
    {   
    }
    
    private static function getPage($url): ?int {
        $queriesStringifyExtracted = parse_url($url, PHP_URL_QUERY);
        parse_str($queriesStringifyExtracted, $nextQueries);

        if (empty($nextQueries)) {
            return null;
        }

        return (int)$nextQueries['page'];
    }
    
    public static function create(array $response) {
        $nextPage = self::getPage($response['next']);
        $previousPage = self::getPage($response['previous']);

        return new self($response['count'], $nextPage, $previousPage, $response['results']);
    }

    public function getCount(): int {
        return $this->count;
    }

    public function getNext(): ?int {
        return $this->next;
    }

    public function getPrevious(): ?int {
        return $this->previous;
    }

    public function getResults(): array {
        return $this->results;
    }
}
