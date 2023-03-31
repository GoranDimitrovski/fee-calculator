<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Model;

use Lendable\Interview\Interpolation\Exception\LoanValue;
use Lendable\Interview\Interpolation\Exception\TermValue;

/**
 * A cut down version of a loan application containing
 * only the required properties for this test.
 */
class LoanApplication
{
    public const LOAN_MAX = 20000.0;

    public const LOAN_MIN = 1000.0;

    public const TERM_MIN = 12;

    public const TERM_MAX = 24;

    private int $term;

    private float $amount;

    public function __construct(int $term, float $amount)
    {
        $this->setTerm($term)
            ->setAmount($amount);
    }

    private function setTerm(int $term): self
    {
        if (!in_array($term, [self::TERM_MIN, self::TERM_MAX])) {
            throw  TermValue::isNotValid($term);
        }

        $this->term = $term;

        return $this;
    }

    /**
     * Term (loan duration) for this loan application
     * in number of months.
     */
    public function getTerm(): int
    {
        return $this->term;
    }

    private function setAmount(float $amount): self
    {
        if ($amount > self::LOAN_MAX) {
            throw  LoanValue::isAboveMax($amount);
        }

        if ($amount < self::LOAN_MIN) {
            throw  LoanValue::isBellowMin($amount);
        }

        $this->amount = $amount;

        return $this;
    }

    /**
     * Amount requested for this loan application.
     */
    public function getAmount(): float
    {
        return $this->amount;
    }
}
