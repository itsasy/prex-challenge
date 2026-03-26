<?php

namespace Src\Application\Favorite\DTOs;

use Src\Domain\Favorite\Entities\Favorite;
use Src\Domain\Gif\Entities\Gif;

final readonly class GetFavoriteByIdResponseDTO implements \JsonSerializable
{
    public function __construct(
        public Favorite $favorite,
        public Gif      $gif
    )
    {
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->favorite->id,
            'gif_id' => $this->favorite->gifId->value(),
            'alias' => $this->favorite->alias,
            'user_id' => $this->favorite->userId,
            'title' => $this->gif->title,
            'url' => $this->gif->url,
            'preview_url' => $this->gif->previewUrl,
        ];
    }
}
