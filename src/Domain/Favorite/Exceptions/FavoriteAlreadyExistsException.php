<?php

namespace Src\Domain\Favorite\Exceptions;

use Exception;

final class FavoriteAlreadyExistsException extends Exception
{
    protected $message = 'This GIF is already in your favorites';
    protected $code = 409;
}
