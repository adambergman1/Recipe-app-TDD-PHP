<?php

class Ingredient
{
    private $name;

    public function __construct(string $name)
    {
        $this->validateName($name);
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
            throw new IngredientContainsNumbersException();
        }
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
