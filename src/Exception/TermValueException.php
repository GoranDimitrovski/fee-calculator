<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Exception;

use InvalidArgumentException;

class TermValueException extends InvalidArgumentException
{
    public static function isNotValid(int $term): static
    {
        return new static(sprintf('Term value %d is not valid.', $term));
    }
}