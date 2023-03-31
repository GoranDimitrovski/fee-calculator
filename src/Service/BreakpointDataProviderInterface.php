<?php

namespace Lendable\Interview\Interpolation\Service;

interface BreakpointDataProviderInterface
{
    public function getBreakpointsForTerm(int $term): array;
}