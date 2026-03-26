<?php

namespace Src\Domain\Gif\ValueObjects;

use Src\Domain\Shared\ValueObjects\StringValueObject;

final class GifId extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->ensureIsValid($value);
        parent::__construct($value);
    }

    protected function ensureIsValid(string $value): void
    {
        if (empty($value)) {
            throw new \InvalidArgumentException('Invalid GIF ID');
        }
    }
}
