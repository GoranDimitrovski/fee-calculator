<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Service;


use Lendable\Interview\Interpolation\Exception\File;
use Lendable\Interview\Interpolation\Exception\TermValue;

class BreakpointDataProvider implements BreakpointDataProviderInterface
{
    public const FILE_PATH = __DIR__ . '/../../data/breakpoints.json';

    private array $breakpoints;

    public function __construct(string $filePath)
    {
        $this->map($filePath);
    }

    public function getBreakpointsForTerm(int $term): array
    {
        return $this->breakpoints[$term] ?? throw TermValue::isNotValid($term);
    }

    /**
     * @param string $filePath
     * @return void
     * @throws File
     */
    protected function map(string $filePath): void
    {
        if (!file_exists($filePath)) {
            throw File::notExists($filePath);
        }

        $this->breakpoints = json_decode(file_get_contents($filePath), true);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw File::isNotValid($filePath);
        }
    }
}