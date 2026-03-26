<?php

namespace Src\Domain\Favorite\ValueObjects;

use Src\Domain\Shared\ValueObjects\StringValueObject;

final class FavoriteId extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->ensureIsValid($value);
        parent::__construct($value);
    }

    protected function ensureIsValid(string $value): void
    {
        if (empty($value)) {
            throw new \InvalidArgumentException('Invalid Favorite ID');
        }
    }
}
