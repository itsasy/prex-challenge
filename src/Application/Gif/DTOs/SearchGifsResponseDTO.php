<?php

namespace Src\Application\Gif\DTOs;

use Src\Domain\Gif\Entities\Gif;

final class SearchGifsResponseDTO implements \JsonSerializable
{
    public function __construct(
        public array $data,
        public int   $total
    )
    {
    }

    public static function fromEntities(array $gifs): self
    {
        $data = array_map(fn(Gif $gif) => [
            'id' => $gif->id->value(),
            'title' => $gif->title,
            'url' => $gif->url,
            'preview_url' => $gif->previewUrl,
        ], $gifs);

        return new self($data, count($data));
    }

    public function jsonSerialize(): array
    {
        return [
            'data' => $this->data,
            'total' => $this->total,
        ];
    }
}
