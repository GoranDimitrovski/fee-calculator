<?php

namespace Lendable\Interview\Interpolation\Service;

use Lendable\Interview\Interpolation\Model\BreakpointsCollection;

interface BreakpointDataProviderInterface
{
    public function getBreakpointsForTerm(int $term): BreakpointsCollection;
}