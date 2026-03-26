<?php

namespace Src\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Domain\Shared\Ports\AuditLoggerInterface;
use Src\Infrastructure\Logging\AuditLogger;

class AuditLoggerProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            AuditLoggerInterface::class,
            AuditLogger::class
        );
    }
}
