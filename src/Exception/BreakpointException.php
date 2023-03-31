<?php

namespace Lendable\Interview\Interpolation\Exception;

use InvalidArgumentException;

class BreakpointException extends InvalidArgumentException
{
    public static function isNotValid(): static
    {
        return new static('The breakpoint is not valid');
    }
}