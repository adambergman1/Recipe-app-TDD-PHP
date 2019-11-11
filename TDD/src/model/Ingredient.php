<?php

class Ingredient
{
    private $ingredient;

    public function __construct(string $ingredient)
    {
        $this->ingredient = $ingredient;
    }

    public function getIngredient()
    {
        return $this->ingredient;
    }
}
