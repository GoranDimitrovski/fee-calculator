<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Service;


use Lendable\Interview\Interpolation\Exception\FileException;
use Lendable\Interview\Interpolation\Exception\TermValueException;
use Lendable\Interview\Interpolation\Model\Breakpoint;
use Lendable\Interview\Interpolation\Model\BreakpointsCollection;

class BreakpointDataProvider implements BreakpointDataProviderInterface
{
    public const FILE_PATH = __DIR__ . '/../../data/breakpoints.json';

    private array $breakpoints;

    public function __construct(string $filePath)
    {
        $this->map($filePath);
    }

    public function getBreakpointsForTerm(int $term): BreakpointsCollection
    {
        return $this->breakpoints[$term] ?? throw TermValueException::isNotValid($term);
    }

    /**
     * @throws FileException
     */
    protected function map(string $filePath): void
    {
        if (!file_exists($filePath)) {
            throw FileException::notExists($filePath);
        }

        $breakpointData = json_decode(file_get_contents($filePath), true);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw FileException::isNotValid($filePath);
        }

        foreach ($breakpointData as $term => $termBreakpoints) {
            $breakpointCollection = new BreakpointsCollection();

            foreach ($termBreakpoints as $amount => $fee) {
                $breakpoint = new Breakpoint($amount, $fee);
                $breakpointCollection->addValue($breakpoint);
            }

            $this->breakpoints[$term] = $breakpointCollection;
        }
    }
}