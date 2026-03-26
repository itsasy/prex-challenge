<?php

namespace Src\Application\Gif\DTOs;

use Src\Domain\Gif\ValueObjects\GifId;

final class GetGifByIdRequestDTO
{
    public function __construct(public GifId $id)
    {
    }

    public static function fromRoute(string $id): self
    {
        return new self(new GifId($id));
    }
}
