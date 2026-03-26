<?php

namespace Src\Infrastructure\Auth;

use Illuminate\Support\Facades\Hash;
use Src\Domain\Auth\Exceptions\InvalidCredentialsException;
use Src\Domain\Auth\Ports\AuthenticatorInterface;
use Src\Domain\Auth\Ports\TokenGeneratorInterface;
use Src\Domain\Auth\Repositories\UserRepositoryInterface;
use Src\Domain\Auth\ValueObjects\Email;
use Src\Domain\Auth\ValueObjects\PlainPassword;

class PassportAuthService implements AuthenticatorInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private TokenGeneratorInterface $tokenGenerator

    )
    {
    }

    public
    function authenticate(Email $email, PlainPassword $password): string
    {
        $user = $this->userRepository->findByEmail($email);

        if (!$user || !Hash::check($password->value(), $user->passwordHash)) {
            throw new InvalidCredentialsException();
        }

        return $this->tokenGenerator->generate($user->id);
    }
}
