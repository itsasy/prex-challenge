<?php

namespace Src\Application\Gif\UseCases;

use Src\Application\Gif\DTOs\SearchGifsRequestDTO;
use Src\Application\Gif\DTOs\SearchGifsResponseDTO;
use Src\Domain\Gif\Ports\GifProviderInterface;

final class SearchGifsUseCase
{
    public function __construct(
        private readonly GifProviderInterface $gifProvider
    )
    {
    }

    public function execute(SearchGifsRequestDTO $request): SearchGifsResponseDTO
    {
        $gifs = $this->gifProvider->search(
            $request->query,
            $request->limit,
            $request->offset
        );

        return SearchGifsResponseDTO::fromEntities($gifs);
    }
}
