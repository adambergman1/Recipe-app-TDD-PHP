<?php

class Ingredient
{
    private $ingredient;

    public function __construct(string $ingredient)
    {
        $this->validateLength($ingredient);
    }

    private function validateLength(string $ingredient): void
    {
        if (strlen($ingredient) >= 60) {
            throw new TooLongIngredientException();
        }
        $this->ingredient = $ingredient;
    }

    public function getIngredient(): string
    {
        return $this->ingredient;
    }
}
