<?php

namespace Src\Application\Auth\DTOs;

use Src\Domain\Auth\ValueObjects\Email;
use Src\Domain\Auth\ValueObjects\PlainPassword;

final class RegisterRequestDTO
{
    public function __construct(
        public string        $name,
        public Email         $email,
        public PlainPassword $password
    )
    {
    }

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            email: new Email($data['email']),
            password: new PlainPassword($data['password'])
        );
    }
}
