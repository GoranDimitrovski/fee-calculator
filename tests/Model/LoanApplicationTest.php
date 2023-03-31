<?php

namespace Lendable\Interview\Interpolation\Tests\Model;

use Lendable\Interview\Interpolation\Exception\LoanValueException;
use Lendable\Interview\Interpolation\Exception\TermValueException;
use Lendable\Interview\Interpolation\Model\LoanApplication;
use PHPUnit\Framework\TestCase;

class LoanApplicationTest extends TestCase
{
    public function testLoanAmountAboveMax()
    {
        static::expectException(LoanValueException::class);
        new LoanApplication(12, 20000.1);
    }

    public function testLoanAmountBellowMin()
    {
        static::expectException(LoanValueException::class);
        new LoanApplication(12, 999.9);
    }

    public function tesIncorrectTermValue()
    {
        static::expectException(TermValueException::class);
        new LoanApplication(15, 1000);
    }
}
