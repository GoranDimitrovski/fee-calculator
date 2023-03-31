<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Exception;

use Exception;

class FileException extends Exception
{
    public static function notExists(string $filePath): static
    {
        return new static(sprintf('The file %s does not exist', $filePath));
    }

    public static function isNotValid(string $filePath): static
    {
        return new static(sprintf('The file %s is not valid', $filePath));
    }
}