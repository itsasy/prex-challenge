<?php

namespace Src\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Domain\Favorite\Repositories\FavoriteRepositoryInterface;
use Src\Infrastructure\Persistence\Eloquent\Repositories\EloquentFavoriteRepository;

class FavoriteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            FavoriteRepositoryInterface::class,
            EloquentFavoriteRepository::class
        );
    }
}
