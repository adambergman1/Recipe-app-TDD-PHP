<?php

class Amount
{
    private $amount;

    public function __construct(float $amount)
    {
        if ($amount >= 100) {
            throw new TooLargeAmountException();
        }
        $this->amount = $amount;
    }

    public function getAmount()
    {
        return $this->amount;
    }
}
