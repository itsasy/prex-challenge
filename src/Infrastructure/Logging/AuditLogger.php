<?php

namespace Src\Infrastructure\Logging;

use Src\Domain\Shared\Ports\AuditLoggerInterface;
use Src\Infrastructure\Persistence\Eloquent\Models\AuditLog;

final class AuditLogger implements AuditLoggerInterface
{
    public function log(
        ?int   $userId,
        string $service,
        ?array $requestBody,
        int    $httpStatus,
        ?array $responseBody,
        string $ip
    ): void
    {
        AuditLog::create([
            'user_id' => $userId,
            'service' => $service,
            'request_body' => $requestBody,
            'http_status' => $httpStatus,
            'response_body' => $responseBody,
            'ip' => $ip,
        ]);
    }
}
