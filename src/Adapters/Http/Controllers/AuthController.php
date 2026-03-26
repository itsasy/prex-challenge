<?php

namespace Src\Adapters\Http\Controllers;

use App\Http\Controllers\Controller;
use Src\Adapters\Http\Requests\LoginRequest;
use Src\Adapters\Http\Requests\RegisterRequest;
use Src\Application\Auth\DTOs\LoginRequestDTO;
use Src\Application\Auth\DTOs\RegisterRequestDTO;
use Src\Application\Auth\UseCases\LoginUseCase;
use Src\Application\Auth\UseCases\RegisterUserUseCase;

class AuthController extends Controller
{
    public function __construct(
        private readonly LoginUseCase        $loginUseCase,
        private readonly RegisterUserUseCase $registerUserUseCase
    )
    {
    }

    public function login(LoginRequest $request)
    {
        $dto = LoginRequestDTO::fromRequest($request->validated());

        $response = $this->loginUseCase->execute($dto);

        return response()->json($response);
    }

    public function register(RegisterRequest $request)
    {
        $dto = RegisterRequestDTO::fromRequest($request->validated());

        $response = $this->registerUserUseCase->execute($dto);

        return response()->json($response);
    }
}
