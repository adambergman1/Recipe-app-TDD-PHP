<?php

class Recipe
{
    private $title;
    private $ingredients = array();

    public function __construct(string $title)
    {
        $this->title = $this->setFirstCharacterToUppercase($title);
    }

    private function setFirstCharacterToUppercase(string $title): string
    {
        return ucfirst($title);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function addIngredient(Ingredient $ingredient): void
    {
        // $this->ingredients[] = (object) ['amount' => $amount, 'measurement' => $measure, 'ingredient' => $ingredient];
        $this->ingredients[] = $ingredient;
    }

    public function getIngredients(): array
    {
        return $this->ingredients;
    }
}
