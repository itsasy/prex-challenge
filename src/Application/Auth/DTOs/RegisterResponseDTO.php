<?php

namespace Src\Application\Auth\DTOs;

use Src\Domain\Auth\Entities\AuthUser;
use Src\Domain\Auth\ValueObjects\Email;

final class RegisterResponseDTO
{
    public function __construct(
        public string $name,
        public string $email,
    )
    {
    }

    public static function fromEntity(AuthUser $favorite): self
    {
        return new self(
            name: $favorite->name,
            email: $favorite->email->value(),
        );
    }

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            email: new Email($data['email']),
        );
    }
}
