<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Service;

use Lendable\Interview\Interpolation\Model\Breakpoint;
use Lendable\Interview\Interpolation\Model\BreakpointsCollection;
use Lendable\Interview\Interpolation\Model\LoanApplication;

class FeeCalculatorIService implements FeeCalculatorInterface
{
    private const MULTIPLE_VALUE = 5;

    public function __construct(private readonly BreakpointDataProviderInterface $breakpointDataProvider)
    {

    }

    public function calculate(LoanApplication $application): float
    {
        $breakpoints = $this->breakpointDataProvider->getBreakpointsForTerm($application->getTerm());
        $calculatedFee = $this->getFee($breakpoints, $application->getAmount());

        return $this->roundUpFee($calculatedFee, $application->getAmount());
    }

    private function getFee(BreakpointsCollection $breakpoints, float $amount): float
    {
        return $this->getNominalFee($breakpoints, $amount) ?? $this->interpolateFee($breakpoints, $amount);
    }

    private function getNominalFee(BreakpointsCollection $breakpoints, float $amount): ?float
    {
        $fee = null;

        /** @var Breakpoint $breakpoint */
        foreach ($breakpoints as $breakpoint) {
            if ($amount === $breakpoint->getAmount()) {
                $fee = $breakpoint->getFee();
                break;
            }
        }

        return $fee;
    }

    private function interpolateFee(BreakpointsCollection $breakpointsData, float $amount): float
    {
        $previousBreakpoint = null;
        $nextBreakpoint = null;

        /** @var Breakpoint $breakpoint */
        foreach ($breakpointsData as $breakpoint) {
            if ($breakpoint->getAmount() < $amount) {
                $previousBreakpoint = $breakpoint;
            } else if ($nextBreakpoint == null) {
                $nextBreakpoint = $breakpoint;
            }
        }

        return $previousBreakpoint->getFee()
            + (($amount - $previousBreakpoint->getAmount()) * ($nextBreakpoint->getFee() - $previousBreakpoint->getFee())
                / ($nextBreakpoint->getAmount() - $previousBreakpoint->getAmount()));
    }

    private function roundUpFee(float $fee, float $amount): float
    {
        $reminder = fmod($amount + $fee, self::MULTIPLE_VALUE);

        if ($reminder > 0) {
            $fee += self::MULTIPLE_VALUE - $reminder;
        }

        return round($fee, 2);
    }
}