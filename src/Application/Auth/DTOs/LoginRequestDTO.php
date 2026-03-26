<?php

namespace Src\Application\Auth\DTOs;

use Src\Domain\Auth\ValueObjects\Email;
use Src\Domain\Auth\ValueObjects\PlainPassword;

final class LoginRequestDTO
{
    public function __construct(
        public Email         $email,
        public PlainPassword $password
    )
    {
    }

    public static function fromRequest(array $data): self
    {
        return new self(
            new Email($data['email']),
            new PlainPassword($data['password'])
        );
    }
}
