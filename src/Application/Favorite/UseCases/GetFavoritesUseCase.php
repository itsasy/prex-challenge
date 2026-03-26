<?php

namespace Src\Application\Favorite\UseCases;

use Src\Domain\Favorite\Repositories\FavoriteRepositoryInterface;

final readonly class GetFavoritesUseCase
{
    public function __construct(
        private FavoriteRepositoryInterface $favoriteRepository
    )
    {
    }

    public function execute(int $userId): array
    {
        $favorites = $this->favoriteRepository->findAllByUser($userId);

        return array_map(fn($favorite) => [
            'id' => $favorite->id,
            'gif_id' => $favorite->gifId->value(),
            'alias' => $favorite->alias,
            'user_id' => $favorite->userId,
        ], $favorites);
    }
}
