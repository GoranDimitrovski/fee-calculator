<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Model;

class Breakpoint
{
    private float $amount;

    private float $fee;


    public function __construct(float $amount, float $fee)
    {
        $this->setAmount($amount)
            ->setFee($fee);
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    private function setAmount(float $amount): Breakpoint
    {
        $this->amount = $amount;
        return $this;
    }

    public function getFee(): float
    {
        return $this->fee;
    }

    private function setFee(float $fee): self
    {
        $this->fee = $fee;

        return $this;
    }
}