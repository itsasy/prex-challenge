<?php

namespace Src\Infrastructure\External\Giphy;

use Illuminate\Support\Facades\Http;
use Src\Domain\Gif\Entities\Gif;
use Src\Domain\Gif\Exceptions\InvalidGifDataException;
use Src\Domain\Gif\Ports\GifProviderInterface;
use Src\Domain\Gif\ValueObjects\GifId;

final class GiphyAdapter implements GifProviderInterface
{
    private const BASE_URL = 'https://api.giphy.com/v1/gifs';

    public function search(string $query, int $limit = 25, int $offset = 0): array
    {
        $response = Http::get(self::BASE_URL . '/search', [
            'api_key' => config('services.giphy.api_key'),
            'q' => $query,
            'limit' => $limit,
            'offset' => $offset,
        ]);

        if ($response->failed()) {
            throw new InvalidGifDataException('Failed to fetch GIFs');
        }

        $data = $response->json('data') ?? [];

        return array_map(
            fn(array $item) => Gif::fromGiphyData($item),
            $data
        );
    }

    public function findById(GifId $id): ?Gif
    {
        $response = Http::get(self::BASE_URL . "/{$id->value()}", [
            'api_key' => config('services.giphy.api_key'),
        ]);

        if ($response->failed()) {
            throw new InvalidGifDataException('Failed to fetch GIF');
        }

        $data = $response->json('data');

        if (empty($data)) {
            return null;
        }

        return Gif::fromGiphyData($data);
    }
}
