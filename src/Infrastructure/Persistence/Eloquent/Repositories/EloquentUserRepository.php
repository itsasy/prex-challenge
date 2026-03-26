<?php

namespace Src\Infrastructure\Persistence\Eloquent\Repositories;

use App\Models\User;
use Src\Domain\Auth\Entities\AuthUser;
use Src\Domain\Auth\Repositories\UserRepositoryInterface;
use Src\Domain\Auth\ValueObjects\Email;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function save(AuthUser $user): AuthUser
    {
        $createdUser = User::create([
            'name' => $user->name,
            'email' => $user->email->value(),
            'password' => $user->passwordHash,
        ]);

        return AuthUser::fromPrimitives(
            id: $createdUser->id,
            name: $createdUser->name,
            email: $createdUser->email,
            passwordHash: $createdUser->password
        );
    }

    public function findByEmail(Email $email): ?AuthUser
    {
        $user = User::query()
            ->where('email', $email->value())
            ->first();

        if (!$user) {
            return null;
        }

        return AuthUser::fromPrimitives(
            id: $user->id,
            name: $user->name,
            email: $user->email,
            passwordHash: $user->password
        );
    }

    public function findById(int $id): ?AuthUser
    {
        $user = User::find($id);

        if (!$user) {
            return null;
        }

        return AuthUser::fromPrimitives(
            id: $user->id,
            name: $user->name,
            email: $user->email,
            passwordHash: $user->password
        );
    }
}
