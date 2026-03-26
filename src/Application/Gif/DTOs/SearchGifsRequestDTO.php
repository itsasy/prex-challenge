<?php

namespace Src\Application\Gif\DTOs;

final class SearchGifsRequestDTO
{
    public function __construct(
        public string $query,
        public int    $limit = 25,
        public int    $offset = 0
    )
    {
    }

    public static function fromRequest(array $data): self
    {
        return new self(
            query: $data['query'],
            limit: $data['limit'] ?? 25,
            offset: $data['offset'] ?? 0
        );
    }
}
