<?php

namespace Src\Adapters\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Src\Domain\Shared\Ports\AuditLoggerInterface;
use Symfony\Component\HttpFoundation\Response;

final readonly class AuditMiddleware
{
    public function __construct(private AuditLoggerInterface $logger)
    {
    }

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $service = $this->getServiceName($request);
        $userId = $request->user()?->id;

        $this->logger->log(
            userId: $userId,
            service: $service,
            requestBody: $request->all(),
            httpStatus: $response->getStatusCode(),
            responseBody: $this->getResponseBody($response),
            ip: $request->ip()
        );

        return $response;
    }

    private function getServiceName(Request $request): string
    {
        $routeName = $request->route()?->getName() ?? 'unknown';
        return str_replace('.', '_', $routeName);
    }

    private function getResponseBody(Response $response): ?array
    {
        if ($response->headers->get('Content-Type') === 'application/json') {
            $content = $response->getContent();
            return json_decode($content, true) ?? null;
        }
        return null;
    }
}
