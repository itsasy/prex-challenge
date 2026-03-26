<?php

namespace Src\Domain\Auth\Entities;

use Src\Domain\Auth\ValueObjects\Email;
use Src\Domain\Auth\ValueObjects\PlainPassword;

final class AuthUser
{
    private function __construct(
        public readonly int    $id,
        public readonly string $name,
        public readonly Email  $email,
        public readonly string $passwordHash
    )
    {
    }

    public static function create(
        string        $name,
        Email         $email,
        PlainPassword $passwordHash,
    ): self
    {
        return new self(
            id: 0,
            name: $name,
            email: $email,
            passwordHash: $passwordHash
        );
    }

    public static function fromPrimitives(int $id, string $name, string $email, string $passwordHash): self
    {
        return new self(
            $id,
            $name,
            new Email($email),
            $passwordHash
        );
    }
}
