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

    public function filterByTag(string $tag): array
    {
        $recipes = array();

        foreach ($this->recipes as $recipe) {
            if ($recipe->getTagName() == $tag) {
                $recipes[] = $recipe;
            }
        }

        return $recipes;
    }

    public function getAllRecipeTitles(): array
    {
        $titles = array();

        foreach ($this->recipes as $recipe) {
            $titles[] = $recipe->getTitle();
        }
        return $titles;
    }

    public function isRecipeSessionEmpty()
    {
        return empty($_SESSION["recipes"]);
    }
}
