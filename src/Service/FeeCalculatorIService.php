<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Service;

use Lendable\Interview\Interpolation\Model\LoanApplication;

class FeeCalculatorIService implements FeeCalculatorInterface
{
    private const MULTIPLE_VALUE = 5;

    public function __construct(private readonly BreakpointDataProviderInterface $breakpointDataProvider)
    {

    }

    public function calculate(LoanApplication $application): float
    {
        $calculatedFee = $this->getFee(
            $this->breakpointDataProvider->getBreakpointsForTerm($application->getTerm()),
            $application->getAmount()
        );

        return $this->roundUpFee($calculatedFee, $application->getAmount());
    }

    private function getFee(array $breakpointsData, float $loanValue): float
    {
        return $breakpointsData[(int)$loanValue] ?? $this->interpolateFee($breakpointsData, $loanValue);
    }

    private function interpolateFee(array $breakpointsData, float $loanValue): float
    {
        $previousKey = null;
        $prevValue = null;
        $nextKey = null;
        $nextValue = null;

        foreach ($breakpointsData as $key => $value) {
            if ($key < $loanValue) {
                $previousKey = $key;
                $prevValue = $value;

            } else if ($nextKey == null) {
                $nextKey = $key;
                $nextValue = $value;
            }
        }

        return $prevValue + (($loanValue - $previousKey) * ($nextValue - $prevValue) / ($nextKey - $previousKey));
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