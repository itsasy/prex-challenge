<?php

namespace Src\Application\Favorite\DTOs;

use Src\Domain\Favorite\Entities\Favorite;

final class StoreFavoriteResponseDTO implements \JsonSerializable
{
    public function __construct(
        public int     $id,
        public string  $gifId,
        public int     $userId,
        public ?string $alias
    )
    {
    }

    public static function fromEntity(Favorite $favorite): self
    {
        return new self(
            id: $favorite->id,
            gifId: $favorite->gifId->value(),
            userId: $favorite->userId,
            alias: $favorite->alias
        );
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'gif_id' => $this->gifId,
            'user_id' => $this->userId,
            'alias' => $this->alias,
        ];
    }
}
