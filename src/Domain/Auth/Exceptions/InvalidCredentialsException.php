<?php

namespace Src\Domain\Auth\Exceptions;

use Exception;

final class InvalidCredentialsException extends Exception
{
    protected $message = 'Invalid credentials';
    protected $code = 401;
}

