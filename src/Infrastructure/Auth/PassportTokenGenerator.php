<?php

namespace Src\Infrastructure\Auth;

use App\Models\User;
use Src\Domain\Auth\Exceptions\InvalidCredentialsException;
use Src\Domain\Auth\Ports\TokenGeneratorInterface;

class PassportTokenGenerator implements TokenGeneratorInterface
{
    public function generate(int $userId): string
    {
        $user = User::find($userId);

        if (!$user) {
            throw new InvalidCredentialsException();
        }

        return $user
            ->createToken('api-token')
            ->accessToken;
    }
}
