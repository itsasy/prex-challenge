<?php

namespace Src\Domain\Shared\Ports;

interface AuditLoggerInterface
{
    public function log(
        ?int   $userId,
        string $service,
        ?array $requestBody,
        int    $httpStatus,
        ?array $responseBody,
        string $ip
    ): void;
}
