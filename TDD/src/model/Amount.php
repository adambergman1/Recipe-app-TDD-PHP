<?php

class Amount
{
    private $amount;

    public function __construct(float $amount)
    {
        $this->validateAmount($amount);
    }

    private function validateAmount(float $amount): void
    {
        if ($amount >= 100) {
            throw new TooLargeAmountException();
        } else if ($amount <= 0) {
            throw new TooSmallAmountException();
        }
        $this->amount = $amount;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
}
