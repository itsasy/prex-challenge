<?php

namespace Src\Domain\Shared\ValueObjects;

abstract class StringValueObject
{
    protected string $value;

    public function __construct(string $value)
    {
        $this->ensureIsValid($value);
        $this->value = trim($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }

    abstract protected function ensureIsValid(string $value): void;
}
