<?php

namespace Src\Infrastructure\Persistence\Eloquent\Repositories;

use Src\Domain\Favorite\Entities\Favorite;
use Src\Domain\Favorite\Exceptions\FavoriteNotFoundException;
use Src\Domain\Favorite\Repositories\FavoriteRepositoryInterface;
use Src\Infrastructure\Persistence\Eloquent\Models\Favorite as EloquentFavorite;

class EloquentFavoriteRepository implements FavoriteRepositoryInterface
{
    public function save(Favorite $favorite): Favorite
    {
        $model = EloquentFavorite::create([
            'user_id' => $favorite->userId,
            'gif_id' => $favorite->gifId->value(),
            'alias' => $favorite->alias,
        ]);

        return Favorite::fromPrimitives(
            id: $model->id,
            userId: $model->user_id,
            gifId: $model->gif_id,
            alias: $model->alias,
        );
    }

    public function exists(int $userId, string $gifId): bool
    {
        return EloquentFavorite::query()
            ->where('user_id', $userId)
            ->where('gif_id', $gifId)
            ->exists();
    }

    public function findAllByUser(int $userId): array
    {
        return EloquentFavorite::where('user_id', $userId)
            ->get()
            ->map(fn($fav) => Favorite::fromPrimitives(
                id: $fav->id,
                userId: $fav->user_id,
                gifId: $fav->gif_id,
                alias: $fav->alias
            ))
            ->toArray();
    }

    public function findById(int $id): ?Favorite
    {
        $fav = EloquentFavorite::find($id);

        if (!$fav) return null;

        return Favorite::fromPrimitives(
            id: $fav->id,
            userId: $fav->user_id,
            gifId: $fav->gif_id,
            alias: $fav->alias
        );
    }

    public function delete(int $id, int $userId): void
    {
        $deleted = EloquentFavorite::query()
            ->where('id', $id)
            ->where('user_id', $userId)
            ->delete();

        if (!$deleted) {
            throw new FavoriteNotFoundException();
        }
    }
}
