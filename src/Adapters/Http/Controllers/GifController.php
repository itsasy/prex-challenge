<?php

namespace Src\Adapters\Http\Controllers;

use App\Http\Controllers\Controller;
use Src\Adapters\Http\Requests\GetGifByIdRequest;
use Src\Adapters\Http\Requests\SearchGifsRequest;
use Src\Application\Gif\DTOs\GetGifByIdRequestDTO;
use Src\Application\Gif\DTOs\SearchGifsRequestDTO;
use Src\Application\Gif\UseCases\GetGifByIdUseCase;
use Src\Application\Gif\UseCases\SearchGifsUseCase;

class GifController extends Controller
{
    public function __construct(
        private readonly SearchGifsUseCase $searchGifsUseCase,
        private readonly GetGifByIdUseCase $getGifByIdUseCase
    )
    {
    }

    public function search(SearchGifsRequest $request)
    {
        $dto = SearchGifsRequestDTO::fromRequest($request->validated());

        $response = $this->searchGifsUseCase->execute($dto);

        return response()->json($response);
    }

    public function show(string $id)
    {
        $dto = GetGifByIdRequestDTO::fromRoute($id);

        $response = $this->getGifByIdUseCase->execute($dto);

        return response()->json($response);
    }
}
