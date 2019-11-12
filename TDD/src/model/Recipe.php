<?php

class Recipe
{
    private $title;
    private $ingredients = array();
    private $servings;

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
        $this->ingredients[] = $ingredient;
    }

    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    public function setServings(int $toBeSaved): void
    {
        $this->servings = $toBeSaved;
    }

    public function getServings(): int
    {
        return $this->servings;
    }
}
