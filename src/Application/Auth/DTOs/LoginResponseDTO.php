<?php

namespace Src\Application\Auth\DTOs;

final readonly class LoginResponseDTO implements \JsonSerializable
{
    public function __construct(
        public string $token,
        public int    $expiresIn = 1800
    )
    {
    }

    public function jsonSerialize(): array
    {
        return [
            'access_token' => $this->token,
            'expires_in' => $this->expiresIn,
        ];
    }
}
