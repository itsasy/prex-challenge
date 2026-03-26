<?php

namespace Src\Application\Gif\UseCases;

use Src\Application\Gif\DTOs\GetGifByIdRequestDTO;
use Src\Application\Gif\DTOs\GetGifByIdResponseDTO;
use Src\Domain\Gif\Exceptions\GifNotFoundException;
use Src\Domain\Gif\Ports\GifProviderInterface;

final readonly class GetGifByIdUseCase
{
    public function __construct(private GifProviderInterface $gifProvider)
    {
    }

    public function execute(GetGifByIdRequestDTO $request): GetGifByIdResponseDTO
    {
        $gif = $this->gifProvider->findById($request->id);

        if (!$gif) {
            throw new GifNotFoundException();
        }

        return new GetGifByIdResponseDTO($gif);
    }
}
