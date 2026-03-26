<?php

namespace Src\Domain\Gif\Entities;

use Src\Domain\Gif\ValueObjects\GifId;

final class Gif
{
    private function __construct(
        public readonly GifId  $id,
        public readonly string $title,
        public readonly string $url,
        public readonly string $previewUrl,
    )
    {
    }

    public static function fromGiphyData(array $data): self
    {
        return new self(
            id: new GifId($data['id']),
            title: $data['title'] ?? 'Sin título',
            url: $data['images']['original']['url'] ?? $data['url'],
            previewUrl: $data['images']['preview_gif']['url'] ?? $data['images']['downsized']['url'] ?? '',
        );
    }
}
