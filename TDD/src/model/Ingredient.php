<?php

class Ingredient
{
    private $ingredient;
    private $name;

    public function __construct(string $ingredient)
    {
        $this->validateIngredient($ingredient);
    }

    private function validateIngredient(string $ingredient): void
    {
        if (strlen($ingredient) >= 60) {
            throw new TooLongIngredientException();
        }
        if (strlen($ingredient) <= 2) {
            throw new TooShortIngredientException();
        }
        if (preg_match('~[0-9]~', $ingredient)) {
            throw new IngredientContainsNumbersException();
        }
        $this->ingredient = $ingredient;
        $this->name = $ingredient;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getIngredient(): string
    {
        return $this->ingredient;
    }
}
