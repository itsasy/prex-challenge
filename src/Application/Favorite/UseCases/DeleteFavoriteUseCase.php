<?php

namespace Src\Application\Favorite\UseCases;

use Src\Domain\Favorite\Repositories\FavoriteRepositoryInterface;

final readonly class DeleteFavoriteUseCase
{
    public function __construct(
        private FavoriteRepositoryInterface $favoriteRepository
    )
    {
    }

    public function execute(int $id, int $userId): void
    {
        $this->favoriteRepository->delete($id, $userId);
    }
}
