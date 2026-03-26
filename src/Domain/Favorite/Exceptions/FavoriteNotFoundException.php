<?php

namespace Src\Domain\Favorite\Exceptions;

use Exception;

final class FavoriteNotFoundException extends Exception
{
    protected $message = 'Favorite not found';
    protected $code = 404;
}
