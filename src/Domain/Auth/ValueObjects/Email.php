<?php

namespace Src\Domain\Auth\ValueObjects;

use Src\Domain\Shared\ValueObjects\StringValueObject;

final class Email extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->ensureIsValid($value);
        parent::__construct($value);
    }

    protected function ensureIsValid(string $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email format');
        }
    }
}
