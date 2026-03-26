<?php

namespace Src\Domain\Auth\ValueObjects;

use Src\Domain\Shared\ValueObjects\StringValueObject;

final class PlainPassword extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->ensureIsValid($value);
        parent::__construct($value);
    }

    protected function ensureIsValid(string $value): void
    {
        if (strlen($value) < 8) {
            throw new \InvalidArgumentException('Password must be at least 8 characters');
        }
    }
}
