<?php

namespace Src\Adapters\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\Adapters\Http\Requests\StoreFavoriteRequest;
use Src\Application\Favorite\DTOs\GetFavoriteByIdRequestDTO;
use Src\Application\Favorite\DTOs\StoreFavoriteRequestDTO;
use Src\Application\Favorite\UseCases\DeleteFavoriteUseCase;
use Src\Application\Favorite\UseCases\GetFavoriteByIdUseCase;
use Src\Application\Favorite\UseCases\GetFavoritesUseCase;
use Src\Application\Favorite\UseCases\StoreFavoriteUseCase;
use Src\Domain\Favorite\ValueObjects\FavoriteId;

class FavoriteController extends Controller
{
    public function __construct(
        private readonly StoreFavoriteUseCase   $storeUseCase,
        private readonly GetFavoritesUseCase    $indexUseCase,
        private readonly GetFavoriteByIdUseCase $showUseCase,
        private readonly DeleteFavoriteUseCase  $deleteUseCase
    )
    {
    }

    public function index(Request $request)
    {
        $favorites = $this->indexUseCase->execute($request->user()->id);
        return response()->json($favorites);
    }

    public function show(string $id)
    {
        $dto = new GetFavoriteByIdRequestDTO(
            userId: auth()->id(),
            id: new FavoriteId($id)
        );

        $favorite = $this->showUseCase->execute($dto);

        return response()->json($favorite);
    }

    public function store(StoreFavoriteRequest $request)
    {
        $dto = StoreFavoriteRequestDTO::fromRequest(
            auth()->id(),
            $request->validated()
        );

        $response = $this->storeUseCase->execute($dto);

        return response()->json($response, 201);
    }

    public function destroy(Request $request, $id)
    {
        $this->deleteUseCase->execute(
            $id,
            $request->user()->id);

        return response()->json(null);
    }
}
