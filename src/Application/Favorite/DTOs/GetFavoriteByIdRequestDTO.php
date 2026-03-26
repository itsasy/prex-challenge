<?php

namespace Src\Application\Favorite\DTOs;

use Src\Domain\Favorite\ValueObjects\FavoriteId;

final readonly class GetFavoriteByIdRequestDTO
{
    public function __construct(
        public int        $userId,
        public FavoriteId $id
    )
    {
    }
}
