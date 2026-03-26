<?php

namespace Src\Domain\Auth\Repositories;

use Src\Domain\Auth\Entities\AuthUser;
use Src\Domain\Auth\ValueObjects\Email;

interface UserRepositoryInterface
{
    public function findByEmail(Email $email): ?AuthUser;

    public function save(AuthUser $user): AuthUser;
}
