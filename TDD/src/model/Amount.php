<?php

class Amount
{
    private $amount;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    public function getAmount()
    {
        return $this->amount;
    }
}
