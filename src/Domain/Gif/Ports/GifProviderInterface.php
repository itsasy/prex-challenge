<?php

namespace Src\Domain\Gif\Ports;

use Src\Domain\Gif\Entities\Gif;
use Src\Domain\Gif\ValueObjects\GifId;

interface GifProviderInterface
{
    public function search(string $query, int $limit = 25, int $offset = 0): array;

    public function findById(GifId $id): ?Gif;
}
