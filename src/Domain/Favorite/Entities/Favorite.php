<?php

namespace Src\Domain\Favorite\Entities;

use Src\Domain\Gif\ValueObjects\GifId;

final class Favorite
{
    private function __construct(
        public readonly int     $id,
        public readonly int     $userId,
        public readonly GifId   $gifId,
        public readonly ?string $alias
    )
    {
    }

    public static function create(
        int     $userId,
        GifId   $gifId,
        ?string $alias = null
    ): self
    {
        return new self(
            id: 0,
            userId: $userId,
            gifId: $gifId,
            alias: $alias
        );
    }

    public static function fromPrimitives(
        int     $id,
        int     $userId,
        string  $gifId,
        ?string $alias
    ): self
    {
        return new self(
            id: $id,
            userId: $userId,
            gifId: new GifId($gifId),
            alias: $alias
        );
    }
}
