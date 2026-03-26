<?php

use App\Providers\AppServiceProvider;
use Src\Infrastructure\Providers\AuditLoggerProvider;
use Src\Infrastructure\Providers\AuthServiceProvider;
use Src\Infrastructure\Providers\FavoriteServiceProvider;
use Src\Infrastructure\Providers\GifServiceProvider;

return [
    AuditLoggerProvider::class,
    AppServiceProvider::class,
    AuthServiceProvider::class,
    GifServiceProvider::class,
    FavoriteServiceProvider::class
];
