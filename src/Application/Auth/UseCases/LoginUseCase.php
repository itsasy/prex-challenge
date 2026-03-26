<?php

namespace Src\Application\Auth\UseCases;

use Src\Application\Auth\DTOs\LoginRequestDTO;
use Src\Application\Auth\DTOs\LoginResponseDTO;
use Src\Domain\Auth\Ports\AuthenticatorInterface;

class LoginUseCase
{
    public function __construct(private AuthenticatorInterface $authService)
    {
    }

    public function execute(LoginRequestDTO $request): LoginResponseDTO
    {
        $token = $this->authService->authenticate($request->email, $request->password);

        return new LoginResponseDTO($token);
    }
}
