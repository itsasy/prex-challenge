<?php

namespace Src\Application\Auth\UseCases;

use Src\Application\Auth\DTOs\RegisterRequestDTO;
use Src\Application\Auth\DTOs\RegisterResponseDTO;
use Src\Domain\Auth\Entities\AuthUser;
use Src\Domain\Auth\Exceptions\UserAlreadyExistsException;
use Src\Domain\Auth\Repositories\UserRepositoryInterface;

class RegisterUserUseCase
{
    public function __construct(
        private UserRepositoryInterface $repository
    )
    {
    }

    public function execute(RegisterRequestDTO $dto): RegisterResponseDTO
    {
        if ($this->repository->findByEmail($dto->email)) {
            throw new UserAlreadyExistsException();
        }

        $user = AuthUser::create(
            name: $dto->name,
            email: $dto->email,
            passwordHash: $dto->password
        );

        $this->repository->save($user);

        return RegisterResponseDTO::fromEntity($user);
    }
}
