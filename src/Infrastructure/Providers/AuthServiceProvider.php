<?php

namespace Src\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use Src\Domain\Auth\Ports\AuthenticatorInterface;
use Src\Domain\Auth\Ports\TokenGeneratorInterface;
use Src\Infrastructure\Auth\PassportAuthService;
use Src\Infrastructure\Auth\PassportTokenGenerator;
use Src\Infrastructure\Persistence\Eloquent\Repositories\EloquentUserRepository;

class AuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            AuthenticatorInterface::class,
            PassportAuthService::class
        );

        $this->app->bind(
            \Src\Domain\Auth\Repositories\UserRepositoryInterface::class,
            EloquentUserRepository::class
        );

        $this->app->bind(
            TokenGeneratorInterface::class,
            PassportTokenGenerator::class
        );
    }

    public function boot(): void
    {
        Passport::tokensExpireIn(now()->addMinutes(30));
        Passport::personalAccessTokensExpireIn(now()->addMinutes(30));
        Passport::refreshTokensExpireIn(now()->addDays(30));
    }
}
