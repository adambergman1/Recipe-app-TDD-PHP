<?php

class RecipeCollection
{
    private $recipes = array();

    public function getNumberOfRecipes(): int
    {
        return count($this->recipes);
    }

    public function addRecipe(Recipe $toBeSaved)
    {
        $this->recipes[] = $toBeSaved;
    }

    public function getRecipes(): array
    {
        return $this->recipes;
    }
}
