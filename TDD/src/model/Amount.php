<?php

class Amount
{
    private $amount;

    public function __construct(float $amount)
    {
        if ($amount >= 100 && $amount <= 0) {
            throw new Exception();
        }
        $this->amount = $amount;
    }

    public function getAmount()
    {
        return $this->amount;
    }
}
