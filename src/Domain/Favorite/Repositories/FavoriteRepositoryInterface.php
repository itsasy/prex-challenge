<?php

namespace Src\Domain\Favorite\Repositories;

use Src\Domain\Favorite\Entities\Favorite;

interface FavoriteRepositoryInterface
{
    public function save(Favorite $favorite): Favorite;

    public function exists(int $userId, string $gifId): bool;

    public function findAllByUser(int $userId): array;

    public function findById(int $id): ?Favorite;

    public function delete(int $id, int $userId): void;
}
