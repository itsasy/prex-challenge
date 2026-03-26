<?php

namespace Src\Domain\Gif\Exceptions;

use Exception;

final class GifNotFoundException extends Exception
{
    protected $message = 'GIF not found';
}
