<?php

namespace Src\Domain\Auth\Ports;

use Src\Domain\Auth\ValueObjects\Email;
use Src\Domain\Auth\ValueObjects\PlainPassword;

interface AuthenticatorInterface
{
    public function authenticate(Email $email, PlainPassword $password): string;
}
