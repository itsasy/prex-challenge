<?php

namespace Src\Domain\Auth\Ports;

interface TokenGeneratorInterface
{
    public function generate(int $userId): string;
}
