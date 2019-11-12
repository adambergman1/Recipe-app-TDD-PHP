<?php

class Ingredient
{
    private $name;
    private $amount;
    private $measurement;

    public function __construct(string $name, Amount $amount = null, Measurement $measure = null)
    {
        $this->validateName($name);
        $this->amount = $amount;
        $this->measurement = $measure;
    }

    private function validateName(string $name): void
    {
        if (strlen($name) >= 60) {
            throw new TooLongIngredientException();
        }
        if (strlen($name) <= 2) {
            throw new TooShortIngredientException();
        }
        if (preg_match('~[0-9]~', $name)) {
            throw new ContainsNumbersException();
        }
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAmount(): float
    {
        return $this->amount->getAmount();
    }

    public function getMeasurement(): string
    {
        return $this->measurement->getMeasurement();
    }
}
