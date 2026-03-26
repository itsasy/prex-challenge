<?php

namespace Src\Domain\Gif\Exceptions;

use Exception;

final class InvalidGifDataException extends Exception
{
    protected $message = 'Invalid data from GIF provider';
}
