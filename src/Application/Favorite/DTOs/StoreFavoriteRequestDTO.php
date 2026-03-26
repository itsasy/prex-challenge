<?php

namespace Src\Application\Favorite\DTOs;

use Src\Domain\Gif\ValueObjects\GifId;

final class StoreFavoriteRequestDTO
{
    public function __construct(
        public readonly int     $userId,
        public readonly GifId   $gifId,
        public readonly ?string $alias = null
    )
    {
    }

    public static function fromRequest(int $userId, array $data): self
    {
        return new self(
            userId: $userId,
            gifId: new GifId($data['gif_id']),
            alias: $data['alias'] ?? null
        );
    }
}
