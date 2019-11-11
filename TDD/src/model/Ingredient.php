<?php

class Ingredient
{
    private $ingredient;

    public function __construct(string $ingredient)
    {
        if (strlen($ingredient) >= 20) {
            throw new Exception();
        }
        $this->ingredient = $ingredient;
    }

    public function getIngredient()
    {
        return $this->ingredient;
    }
}
