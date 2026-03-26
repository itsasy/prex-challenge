<?php

namespace Src\Domain\Favorite\Ports;

use Src\Domain\Favorite\Entities\Favorite;
use Src\Domain\Gif\ValueObjects\GifId;

interface FavoriteInterface
{
    public function save(Favorite $favorite): Favorite;

    public function remove(int $userId, GifId $gifId): void;
}
