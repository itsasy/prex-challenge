<?php

namespace Src\Application\Favorite\UseCases;

use Src\Application\Favorite\DTOs\StoreFavoriteRequestDTO;
use Src\Application\Favorite\DTOs\StoreFavoriteResponseDTO;
use Src\Domain\Favorite\Entities\Favorite;
use Src\Domain\Favorite\Exceptions\FavoriteAlreadyExistsException;
use Src\Domain\Favorite\Repositories\FavoriteRepositoryInterface;

final readonly class StoreFavoriteUseCase
{
    public function __construct(
        private FavoriteRepositoryInterface $favoriteRepository
    )
    {
    }

    public function execute(StoreFavoriteRequestDTO $request): StoreFavoriteResponseDTO
    {
        if ($this->favoriteRepository->exists(
            $request->userId,
            $request->gifId->value()
        )) {
            throw new FavoriteAlreadyExistsException();
        }

        $favorite = Favorite::create(
            userId: $request->userId,
            gifId: $request->gifId,
            alias: $request->alias
        );

        $favorite = $this->favoriteRepository->save($favorite);

        return StoreFavoriteResponseDTO::fromEntity($favorite);
    }
}
