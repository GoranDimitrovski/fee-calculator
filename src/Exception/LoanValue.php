<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Exception;

use InvalidArgumentException;
use Lendable\Interview\Interpolation\Model\LoanApplication;

class LoanValue extends InvalidArgumentException
{
    public static function isAboveMax(float $loanValue): static
    {
        return new static(sprintf('The loan value %s is above the maximum of %d', $loanValue, LoanApplication::LOAN_MAX));
    }

    public static function isBellowMin(float $loanValue): static
    {
        return new static(sprintf('The loan value %s is bellow the minimum of %d', $loanValue, LoanApplication::LOAN_MIN));
    }
}