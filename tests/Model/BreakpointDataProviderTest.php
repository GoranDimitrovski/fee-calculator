<?php

namespace Lendable\Interview\Interpolation\Tests\Model;

use Lendable\Interview\Interpolation\Exception\FileException;
use Lendable\Interview\Interpolation\Exception\TermValueException;
use Lendable\Interview\Interpolation\Service\BreakpointDataProvider;
use PHPUnit\Framework\TestCase;

class BreakpointDataProviderTest extends TestCase
{
    public function testInvalidFile()
    {
        static::expectException(FileException::class);
        $breakpointsDataProvider = new BreakpointDataProvider('');
        $breakpointsDataProvider->getBreakpointsForTerm(1);
    }

    public function testInvalidTerm()
    {
        static::expectException(TermValueException::class);
        $breakpointsDataProvider = new BreakpointDataProvider(__DIR__.'/../../data/breakpoints.json');
        $breakpointsDataProvider->getBreakpointsForTerm(1);
    }
}