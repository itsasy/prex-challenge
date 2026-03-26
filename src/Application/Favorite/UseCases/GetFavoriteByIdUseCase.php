<?php

namespace Src\Application\Favorite\UseCases;

use Src\Application\Favorite\DTOs\GetFavoriteByIdRequestDTO;
use Src\Application\Favorite\DTOs\GetFavoriteByIdResponseDTO;
use Src\Domain\Favorite\Exceptions\FavoriteNotFoundException;
use Src\Domain\Favorite\Repositories\FavoriteRepositoryInterface;
use Src\Domain\Gif\Ports\GifProviderInterface;

final readonly class GetFavoriteByIdUseCase
{
    public function __construct(
        private FavoriteRepositoryInterface $favoriteRepository,
        private GifProviderInterface        $gifProvider
    )
    {
    }

    public function execute(GetFavoriteByIdRequestDTO $request): GetFavoriteByIdResponseDTO
    {
        $favorite = $this->favoriteRepository->findById(
            (int)$request->id->value()
        );

        if (!$favorite) {
            throw new FavoriteNotFoundException();
        }

        $gif = $this->gifProvider->findById($favorite->gifId);

        return new GetFavoriteByIdResponseDTO($favorite, $gif);
    }
}
