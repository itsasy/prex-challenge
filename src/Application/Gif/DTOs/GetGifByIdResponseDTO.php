<?php

namespace Src\Application\Gif\DTOs;

use Src\Domain\Gif\Entities\Gif;

final readonly class GetGifByIdResponseDTO implements \JsonSerializable
{
    public function __construct(
        public Gif $gif
    )
    {
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->gif->id->value(),
            'title' => $this->gif->title,
            'url' => $this->gif->url,
            'preview_url' => $this->gif->previewUrl,
            'alias' => $this->gif->alias ?? null,
        ];
    }
}
