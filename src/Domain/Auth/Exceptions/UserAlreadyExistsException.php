<?php

namespace Src\Domain\Auth\Exceptions;

use Exception;

final class UserAlreadyExistsException extends Exception
{
    protected $message = 'User already exists';
    protected $code = 409;
}
