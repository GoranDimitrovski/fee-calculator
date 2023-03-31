<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Model;

use Lendable\Interview\Interpolation\Exception\BreakpointException;

class BreakpointsCollection implements \Iterator
{
    private array $breakpoints = [];
    private int $position = 0;

    public function addValue(Breakpoint $breakpoint): void
    {
        if ($this->last()?->getAmount() >= $breakpoint->getAmount()) {
            throw BreakpointException::isNotValid();
        }

        $this->breakpoints[] = $breakpoint;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function current(): mixed
    {
        return $this->breakpoints[$this->position];
    }

    public function next(): void
    {
        $this->position++;
    }

    public function valid(): bool
    {
        return isset($this->breakpoints[$this->position]);
    }

    private function last(): ?Breakpoint
    {
        $lastBreakpoint = end($this->breakpoints);
        $this->rewind();

        return false === $lastBreakpoint ? null : $lastBreakpoint;
    }
}
