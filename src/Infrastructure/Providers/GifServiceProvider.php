<?php

namespace Src\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Domain\Gif\Ports\GifProviderInterface;
use Src\Infrastructure\External\Giphy\GiphyAdapter;

class GifServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            GifProviderInterface::class,
            GiphyAdapter::class
        );
    }
}
