<?php

namespace Lendable\Interview\Interpolation\Tests\Model;

use Lendable\Interview\Interpolation\Exception\BreakpointException;
use Lendable\Interview\Interpolation\Model\Breakpoint;
use Lendable\Interview\Interpolation\Model\BreakpointsCollection;
use PHPUnit\Framework\TestCase;

class BreakpointCollectionTest extends TestCase
{
    public function testAddBreakpointWithLowerAmount()
    {
        static::expectException(BreakpointException::class);
        $breakpointCollection = new BreakpointsCollection();

        $breakpoint = new Breakpoint(1000.0, 50.0);
        $breakpointCollection->addValue($breakpoint);

        $breakpoint = new Breakpoint(999.0, 50.0);
        $breakpointCollection->addValue($breakpoint);
    }

    public function testAddBreakpointWithExistingAmount()
    {
        static::expectException(BreakpointException::class);
        $breakpointCollection = new BreakpointsCollection();

        $breakpoint = new Breakpoint(1000.0, 50.0);
        $breakpointCollection->addValue($breakpoint);
        //try to add it for a second time
        $breakpointCollection->addValue($breakpoint);
    }
}